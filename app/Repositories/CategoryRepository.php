<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function allCategories()
    {
        return Category::latest()->paginate(10);
    }

    public function storeCategory($data)
    {
        return Category::create($data);
    }

    public function findCategory($id)
    {
        return Category::find($id);
    }

    public function updateCategory($data, $id)
    {
        $category = Category::where("id", $id)->first();
        $category->name = $data["name"];
        $category->slug = $data["slug"];
        $category->save();
    }

    public function destroyCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
    }
}
