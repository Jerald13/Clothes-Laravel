<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\User;
use App\Models\Stock;
use App\Models\product_images;
use Illuminate\Database\QueryException;


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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProduct(Request $request)
    {
        $data = $request;

        $sizes = $data->input("size");
        $quantity = $data->input("quantity");

        //table product insert

        $product = $this->prodRepository->create([
            "category_id" => $data["category_id"],
            "name" => $data["prodName"],
            "description" => $data["prodDesc"],
            "price" => $data["prodPrice"],
        ]);

        $latestProdId = $this->prodRepository->getLatestId();

        for ($i = 0; $i < count($sizes); $i++) {
            if ((int)$sizes[$i] >= 1 && (int)$sizes[$i] <= 5 && (int)$quantity[$i] != null) {
                $this->stockRepository->create([
                    "size_id" => $sizes[$i],
                    "product_id" => $latestProdId,
                    "quantity" => $quantity[$i],
                ]);
            }
        }

        $this->uploadImage($request, $latestProdId);


        return view("editor.product.productDisplay");
    }

    public function uploadImage(Request $request, $latestProdId)
    {

        // Validate the uploaded files
        $validatedData = $request->validate([
            "images.*" => "required|image|max:20000",
        ]);

        $images = $request->file("images");
        $imageData = [];
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
        $categories = $this->cateRepository->allCategories();
        $sizes = $this->sizeRepository->getAll();

        return view(
            "editor.product.productCreate",
            compact("categories", "sizes")
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
        $data = Product::all();
        return view("product", ["products" => $data]);
    }

    public function shop()
    {
        $products = $this->prodRepository->getAll();
        $categories = $this->cateRepository->allCategories();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request;

        $sizes = $data->input("size");
        $colors = $data->input("color");
        $quantity = $data->input("quantity");

        //table product insert
        $product = $this->prodRepository->update($id, [
            "category_id" => $data["category_id"],
            "name" => $data["prodName"],
            "description" => $data["prodDesc"],
            "price" => $data["prodPrice"],
        ]);

        $product = $this->prodRepository->getById($id);
        $stocks = $product->stocks;


        $count = 0;
        foreach ($stocks as $stock) {


            $this->stockRepository->update($stock->id, [
                "color_id" => $colors[$count],
                "size_id" => $sizes[$count],
                "product_id" => $id,
                "quantity" => $quantity[$count],
            ]);
            $count++;
        }

        return redirect()->route('editor.product.productEdit', ['product' => $id]);
    }

    public function getSingleProd($id)
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

        $categories = $this->cateRepository->allCategories();
        $sizes = $this->sizeRepository->getAll();
        $images = $this->ProductImageRepository->getAllByProductId($id);
        $categoryProduct = $this->prodRepository->getCategoryByProductId($id);
        $productsSameCate = $categoryProduct->products;
        

        return view(
            $route,
            compact(
                "product",
                "stocks",
                "stockVariableSize",
                "sizes",
                "categories",
                "images",
                "productsSameCate"
            )
        );
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
        return redirect("editor/Product/productDisplay")->with('msg_deleted', 'Product has been successfully deleted.');
    }
}
