<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->allCategories();

        return view("editor.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("editor.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|max:255",
            "slug" => "required|string|max:255",
        ]);

        $this->categoryRepository->storeCategory($data);

        return redirect()
            ->route("categories.index")
            ->with("message", "Category Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->findCategory($id);

        return view("editor.categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "slug" => "required|string|max:255",
        ]);

        $this->categoryRepository->updateCategory($request->all(), $id);

        return redirect()
            ->route("categories.index")
            ->with("message", "Category Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryRepository->destroyCategory($id);

        return redirect()
            ->route("categories.index")
            ->with("status", "Category Delete Successfully");
    }

    // private $categoryRepository;

    // public function __construct(CategoryRepositoryInterface $categoryRepository)
    // {
    //     $this->categoryRepository = $categoryRepository;
    // }
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     $categories = $this->categoryRepository->allCategories();

    //     return view("categories.index", compact("categories"));
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     return view("categories.create");
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         "name" => "required|string|max:255",
    //         "status" => "required|string|max:255",
    //         "product_count" => "required|integer",
    //     ]);

    //     $this->categoryRepository->storeCategory($data);

    //     return redirect()
    //         ->route("categories.index")
    //         ->with("message", "Category Created Successfully");
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     $category = $this->categoryRepository->findCategory($id);

    //     return view("categories.edit", compact("category"));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         "name" => "required|string|max:255",
    //         "status" => "required|string|max:255",
    //         "product_count" => "required|integer",
    //     ]);

    //     $this->categoryRepository->updateCategory($request->all(), $id);

    //     return redirect()
    //         ->route("categories.index")
    //         ->with("message", "Category Updated Successfully");
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $this->categoryRepository->destroyCategory($id);

    //     return redirect()
    //         ->route("categories.index")
    //         ->with("status", "Category Delete Successfully");
    // }

    //     public function categoryCreateForm()
    //     {
    //         return view("editor.categoryCreate");
    //     }

    //     public function categoryCreate(Request $req)
    //     {
    //         if ($req->session()->has("user")) {
    //             $cart = new Category();
    //             $cart->name = $req->name;
    //             $cart->status = $req->has("status") ? $req->status : "active";
    //             $cart->save();
    //             return redirect("/");
    //         } else {
    //             return redirect("/login");
    //         }
    //     }

    //     public function categoryDisplay()
    //     {
    //         $data = Category::all();
    //         return view("editor.categoryDisplay", ["catogories" => $data]);
    //     }
}
