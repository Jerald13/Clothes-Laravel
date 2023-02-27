<?php
namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function allCategories();
    public function storeCategory($data);
    public function findCategory($id);
    public function updateCategory($data, $id);
    public function destroyCategory($id);
}
