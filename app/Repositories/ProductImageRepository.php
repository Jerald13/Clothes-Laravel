<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ProductImageRepositoryInterface;
use App\Models\Product_images;

class ProductImageRepository implements ProductImageRepositoryInterface
{

    public function getAll()
    {
        return product_images::all();
    }

    public function getById($id)
    {
        return product_images::find($id);
    }

    public function create($data)
    {
        return product_images::create($data);
    }

    public function update($id, $data)
    {
        $prod = product_images::find($id);
        $prod->update($data);
        return $prod;
    }

    public function delete($id)
    {
        product_images::destroy($id);
    }

    public function getAllByProductId($productId)
    {
        return product_images::where('product_id', $productId)->get();
    }
}
