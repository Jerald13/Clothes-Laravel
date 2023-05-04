<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ProductImageRepositoryInterface;
use App\Models\Product_images;

class ProductImageRepository implements ProductImageRepositoryInterface
{
    
    public function getAll()
    {
        return Product_images::all();
    }

    public function getById($id)
    {
        return Product_images::find($id);
    }

    public function create($data)
    {
        return Product_images::create($data);
    }

    public function update($id, $data)
    {
        $prod = Product_images::find($id);
        $prod->update($data);
        return $prod;
    }

    public function delete($id)
    {
        Product_images::destroy($id);
    }
}

