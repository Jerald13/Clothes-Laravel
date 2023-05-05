<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements ProductRepositoryInterface
{
    public function allCategories()
    {
        return Category::latest()->paginate(10);
    }
    public function getAll()
    {
        return Category::latest()->paginate(10);
    }
    public function getById($id)
    {
        return Category::find($id);
    }

    public function create($data)
    {
        return Category::create($data);
    }
    public function delete($id)
    {
        Category::destroy($id);
    }

    public function update($id,$data)
    {
        var_dump($id);
        $prodImage = Category::find($id);
     
        $prodImage->update($data);
        return $prodImage ;
    }

    public function storeCategory($data)
    {
        return Category::create($data);
    }
}
