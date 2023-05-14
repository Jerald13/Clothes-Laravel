<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\Stock;
use App\Models\product_images;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;


use App\Models\Order;
use Illuminate\Http\UploadedFile;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SizeRepository;
use App\Repositories\ProductImageRepository;
use App\Repositories\UserRepository;
use App\Repositories\StockRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $prodRepository;
    protected $sizeRepository;
    protected $colorRepository;
    protected $cateRepository;
    protected $stockRepository;
    protected $ProductImageRepository;

    public function __construct(
        ProductRepository $prodRepository,
        CategoryRepository $cateRepository,
        SizeRepository $sizeRepository,
        StockRepository $stockRepository,
        ProductImageRepository $productImageRepository
    ) {
        $this->prodRepository = $prodRepository;
        $this->cateRepository = $cateRepository;
        $this->sizeRepository = $sizeRepository;
        $this->ProductImageRepository = $productImageRepository;
        $this->stockRepository = $stockRepository;
    }



    public function getQuantity(Request $request)
    {
        $sizeId = $request->input("size");
        $prodId = $request->input("productId");

        $stock = Stock::where("size_id", $sizeId)
            ->where("product_id", $prodId)
            ->first();
        if ($stock) {
            $quantity = $stock->quantity;
        } else {
            $quantity = 0;
        }

        return response()->json(["quantity" => $quantity]);
    }

    public function getAllProds()
    {
        $products =  $this->prodRepository->getAll();
        $route = Route::getCurrentRoute()->getName();

        return view('editor.product.productDisplay', compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayCreateForm()
    {
        $categories = $this->cateRepository->getAll();
        $sizes = $this->sizeRepository->getAll();
        $tags = Tag::all();
    
        return view(
            "editor.product.productCreate",
            compact("categories", "sizes", "tags")
        );
    }
    
    /**
     * Get All the project
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllProduct()
    {
        $products = $this->prodRepository->getAll();
        return view("editor.product.productDisplay", compact("products"));
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return $this->getAllProdIndex();
    }

    public function shop()
    {
        $products = $this->prodRepository->getAll();
        $categories = $this->cateRepository->getAll();
        $images = $this->ProductImageRepository->getAll();

        return view("shop", compact("products", "categories", "images"));
    }

    function detail($id)
    {
        $data = Product::find($id);
        return view("detail", ["product" => $data]);
    }

    function search(Request $req)
    {
        $data = Product::where(
            "name",
            "like",
            "%" . $req->input("query") . "%"
        )->get();
        return view("search", ["products" => $data]);
    }

    function addToCart(Request $req)
    {
        if ($req->session()->has("user")) {
            $cart = new Cart();
            $cart->user_id = $req->session()->get("user")["id"];
            $cart->product_id = $req->product_id;
            $cart->save();
            return redirect("/");
        } else {
            return redirect("/login");
        }
    }

    static function cartItem()
    {
        $userId = Session::get("user")["id"];
        return Cart::where("user_id", $userId)->count();
    }

    static function cartList()
    {
        $userId = Session::get("user")["id"];

        $products = DB::table("cart")
            ->join("products", "cart.product_id", "=", "products.id")
            ->where("cart.user_id", $userId)
            ->select("products.*", "cart.id as cart_id")
            ->get();
        return view("cartList", ["products" => $products]);
    }

    function removeCart($id)
    {
        Cart::destroy($id);
        return redirect("cartlist");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->code = $request->get("code");
        $product->name = $request->get("name");
        $product->save();
        return redirect("products")->with(
            "success",
            "Information has been added"
        );
        // return redirect('products')->with('success', 'Information has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view("product.ProductCreate", ["product" => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProduct(Request $request)
    {
        $data = $request;

        $sizes = array_slice($data->input("size"), 0, 5); // Get the first 5 values of the input array
        $sizes = array_map('intval', $sizes); // Cast each value in the array to an integer
        $quantity = array_slice($data->input("quantity"), 0, 5); // Get the first 5 values of the input array
        $quantity = array_map('intval', $quantity); // Cast each value in the array to an integer
        $category_id = intval($data->input("category_id"));
        $productName = substr($data["prodName"], 0, 100); // Truncate the input to 100 characters
        $prodDes = substr($data["prodDesc"], 0, 1000); // Truncate the input to 1000 characters
        $prodPrice = floatval($data["prodPrice"]); // Cast the input to a float


        $images = $request->file("images");
        foreach ($images as $image) {
            $msg = ''; // Clear error messages from previous iteration

            if (isset($image)) {
                if ($image->isValid() && in_array($image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                    $imageSize = $image->getSize();
                    $maxSize = 2000000; // 2 MB

                    if ($imageSize > $maxSize) {
                        // Invalid image file
                        $msg .= 'The file size is too large.<br>';
                    }
                } else {
                    // Invalid image file
                    $msg .= 'Invalid file type or file not found<br>';
                }
            } else {
                // No image file uploaded
                $msg .= 'No image file uploaded.<br>';
            }

            if (!empty($msg)) {
                return redirect()->route('editor.product.productCreate')->with('msg-error', $msg);
            }
        }


        $product = $this->prodRepository->create([
            "category_id" => $category_id,
            "name" => $productName,
            "description" =>   $prodDes,
            "price" =>  $prodPrice,
        ]);

        $latestProdId = $this->prodRepository->getLatestId();
        $products = $this->prodRepository->getAll();


        for ($i = 0; $i < count($sizes); $i++) {
            if ((int)$sizes[$i] >= 1 && (int)$sizes[$i] <= 5 && (int)$quantity[$i] != null) {
                $this->stockRepository->create([
                    "size_id" => $sizes[$i],
                    "product_id" => $latestProdId,
                    "quantity" => $quantity[$i],
                ]);
            }
        }
        unset($sizes); // free memory 
        unset($quantity);
        unset($quantity);
        unset($quantity);
        unset($quantity);




        $this->uploadImage($request, $latestProdId);


        return redirect()->route('editor.product.productDisplay', ['products' => $products])->with('msg', 'Product has been successfully created.');
    }

    public function uploadImage(Request $request, $latestProdId)
    {
        $images = $request->file("images");

        try {

            foreach ($images as $image) {
                $this->ProductImageRepository->create([
                    "name" => $image->getClientOriginalName(),
                    "data" => $image->get(),
                    "mime" => $image->getClientMimeType(),
                    "product_id" => $latestProdId
                ]);
            }
            // your database query here
        } catch (QueryException $e) {
            $errorMessage = $e->getMessage();
            var_dump("Database error: $errorMessage");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request;

        $validatedData = $data->validate([
            'prodName' => 'required|string|max:100',
            'prodDesc' => 'required|string|max:1000',
            'prodPrice' => 'required|numeric|min:0',
            'category_id' => 'required|integer|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2000',
            'size.*' => 'required|integer|min:1',
            'quantity.*' => 'required|integer|min:1',
        ]);

        if (!$validatedData) {
            return redirect()->route('editor.product.productCreate')->with('msg-error', 'Image cannot more than 20MB and the find must be a image file.');
        }


        $sizes = array_slice($data->input("size"), 0, 5); // Get the first 5 values of the input array
        $sizes = array_map('intval', $sizes); // Cast each value in the array to an integer
        $quantity = array_slice($data->input("quantity"), 0, 5); // Get the first 5 values of the input array
        $quantity = array_map('intval', $quantity); // Cast each value in the array to an integer
        $category_id = intval($data->input("category_id"));
        $productName = substr($data["prodName"], 0, 100); // Truncate the input to 100 characters
        $prodDes = substr($data["prodDesc"], 0, 1000); // Truncate the input to 1000 characters
        $prodPrice = floatval($data["prodPrice"]); // Cast the input to a float

        $productId = $id;


        //table product insert
        $product = $this->prodRepository->update($productId, [
            "category_id" => $category_id,
            "name" =>  $productName,
            "description" => $prodDes,
            "price" => $prodPrice,
        ]);

        $product = $this->prodRepository->getById($productId);
        $stocks = $product->stocks;
        $products = $this->prodRepository->getAll();

        $count = 0;


        foreach ($stocks as $stock) {
            $this->stockRepository->delete($stock->id);
        }

        foreach ($sizes as $size) {
            if ($size != 0) {
                $this->stockRepository->create([
                    "size_id" => $size,
                    "product_id" => $productId,
                    "quantity" => $quantity[$count],
                ]);
            }
            $count++;
        }



        if ($validatedData) {
            $this->updateImage($request, $product);
        }

        return redirect()->route('editor.product.productEdit', ['product' => $productId, 'products' => $products])->with('msg', 'Product has been successfully updated.');
    }

    public function updateImage(Request $request, $product)
    {
        $images = $request->file("images");
        $imageData = [];
        $imagesExist = $product->images;
        try {
            foreach ($imagesExist as $image) {
                $this->ProductImageRepository->delete($image->id);
            }
            for ($i = 0; $i < count($images); $i++) {

                $this->ProductImageRepository->create([
                    "name" => $images[$i]->getClientOriginalName(),
                    "data" => $images[$i]->get(),
                    "mime" => $images[$i]->getClientMimeType(),
                    "product_id" => $product->id
                ]);
            }
            // your database query here
        } catch (QueryException $e) {
            $errorMessage = $e->getMessage();
            var_dump("Database error: $errorMessage");
        }
    }



    public function getSingleProdAdmin($id)
    {
        $route = Route::getCurrentRoute()->getName();

        $product = $this->prodRepository->getById($id);
        // $stocks = Stock::where('product_id', $product->id)->get();

        $stocks = $product->stocks;
        $stockVariableSize = $product
            ->stocks()
            ->distinct()
            ->get(["size_id"]); // to get the stock has what izes

        $sizes = $this->sizeRepository->getAll();

        $categories = $this->cateRepository->getAll();
        $sizes = $this->sizeRepository->getAll();
        $images = $this->ProductImageRepository->getAllByProductId($id);
        $categoryProduct = $this->prodRepository->getCategoryByProductId($id);
        $productsSameCate = $categoryProduct->products;


        return view(
            "editor.Product.productEdit",
            compact(
                "product",
                "stocks",
                "stockVariableSize",
                "sizes",
                "categories",
                "images"
            )
        );
    }

    public function getSingleProdClient($id)
    {
        $product = $this->prodRepository->getById($id);
        // $stocks = Stock::where('product_id', $product->id)->get();

        $stocks = $product->stocks;
        $stockVariableSize = $product
            ->stocks()
            ->distinct()
            ->get(["size_id"]); // to get the stock has what izes

        $sizes = $this->sizeRepository->getAll();

        $categories = $this->cateRepository->getAll();
        $sizes = $this->sizeRepository->getAll();
        $images = $this->ProductImageRepository->getAllByProductId($id);
        $categoryProduct = $this->prodRepository->getCategoryByProductId($id);
        $productsSameCate = $categoryProduct->products;


        return view(
            "productDetails",
            compact(
                "product",
                "sizes",
                "stockVariableSize",
                "categories",
                "images",
                "productsSameCate"
            )
        );
    }

    public function getAllProdIndex()
    {
        $products = $this->prodRepository->getAll();
        $categories = $this->cateRepository->getAll();
        $images = $this->ProductImageRepository->getAll();

        $user = session()->get("user");
        $carts = null;
        if ($user) {
            $carts = $user
                ->carts()
                ->with("product")
                ->get();
            session()->put("carts", $carts);
        } else {
            session()->forget("carts");
        }

        return view("product", compact("products", "categories", "images"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->prodRepository->getById($id);
        if (!empty($product->stocks)) {
            $stocks = $product->stocks;

            foreach ($stocks as $stock) {
                $this->stockRepository->delete($stock->id);
            }
        }

        $this->prodRepository->delete($id);
        return redirect("editor/Product/productDisplay")->with('msg', 'Product has been successfully deleted.');
    }

    public function displayInXML()
    {
        $products = Product::latest()->paginate(10);

        $xml = new \SimpleXMLElement("<products/>");

        foreach ($products as $product) {
            $productXml = $xml->addChild("product");
            $productXml->addChild("id", $product->id);
            $productXml->addChild("category_id", $product->category_id);
            $productXml->addChild("name", $product->name);
            $productXml->addChild("price", $product->price);
            $productXml->addChild("description", $product->description);
        }

        $xmlString = $xml->asXML();

        $response = new Response($xmlString);
        $response->header("Content-Type", "application/xml");

        return $response;
    }

    public function displayInXSL()
    {
        $products = Product::latest()->paginate(10);

        $xml = new \SimpleXMLElement("<products/>");

        foreach ($products as $product) {
            $productXml = $xml->addChild("product");
            $productXml->addChild("id", $product->id);
            $productXml->addChild("category_id", $product->category_id);
            $productXml->addChild("name", $product->name);
            $productXml->addChild("price", $product->price);
            $productXml->addChild("description", $product->description);
        }

        $xmlString = $xml->asXML();

        // Load the XSL stylesheet
        $xsl = new \DOMDocument();
        $xsl->load(base_path("resources/views/editor/Product/product.xsl"));

        // Load the XML data
        $xmlData = new \DOMDocument();
        $xmlData->loadXML($xmlString);

        // Apply the XSL transformation
        $xsltProcessor = new \XSLTProcessor();
        $xsltProcessor->importStylesheet($xsl);
        $htmlString = $xsltProcessor->transformToXML($xmlData);

        // Create and return the response
        $response = new Response($htmlString);
        $response->header("Content-Type", "text/html");

        return $response;
    }
}
