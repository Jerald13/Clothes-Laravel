<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Session;

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
            "status" => "required|string|max:255",
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
            "status" => "required|string|max:255",
            // "product_count" => "required|integer",
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
        $category = $this->categoryRepository->findCategory($id);

        if ($category->product_count > 0) {
            $errorMessage =
                "Cannot delete category as it has products associated with it";
            return redirect()
                ->route("editor/page-404")
                ->with("errorMessage", $errorMessage);
        } else {
            $this->categoryRepository->destroyCategory($id);

            return redirect()
                ->route("categories.index")
                ->with("status", "Category Delete Successfully");
        }
    }

    public function status(Request $request, Category $category)
    {
        $category->status = $request->input("status");
        $category->save();

        return response()->json(["status" => $category->status]);
    }
}
