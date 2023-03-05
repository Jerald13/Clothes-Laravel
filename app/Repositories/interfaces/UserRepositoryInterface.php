<?php
namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function allUser();
    public function storeUser($data);
    public function findUser($id);
    public function updateUser($data, $id);
    // public function destroyUser($id);
}
