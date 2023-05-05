<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Size;

class SizeRepository implements ProductRepositoryInterface
{
    
    public function getAll()
    {
        return Size::all();
    }

    public function getById($id)
    {
        return Size::find($id);
    }

    public function create($data)
    {
        return Size::create($data);
    }

    public function update($id, $data)
    {
        $prod = Size::find($id);
        $prod->update($data);
        return $prod;
    }

    public function delete($id)
    {
        Size::destroy($id);
    }
}

