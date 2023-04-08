<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ColorRepositoryInterface;
use App\Models\Color;

class ColorRepository implements ColorRepositoryInterface
{
    
    public function getAll()
    {
        return Color::all();
    }

    public function getById($id)
    {
        return Color::find($id);
    }

    public function create($data)
    {
        return Color::create($data);
    }

    public function update($id, $data)
    {
        $prod = Color::find($id);
        $prod->update($data);
        return $prod;
    }

    public function delete($id)
    {
        Color::destroy($id);
    }
}

