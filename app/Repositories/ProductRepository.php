<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    
    public function getAll()
    {
        return Product::all();
    }

    public function getById($id)
    {
        return Product::find($id);
    }

    public function create($data)
    {
        return Product::create($data);
    }

    public function update($id, $data)
    {
        $prod = Product::find($id);
        $prod->update($data);
        return $prod;
    }

    public function delete($id)
    {
        Product::destroy($id);
    }

    public function getLatestId(){
        return Product::latest()->value('id');
    }
}

