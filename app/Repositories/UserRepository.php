<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function allUser()
    {
        return User::latest()->paginate(10);
    }

    public function storeUser($data)
    {
        return User::create($data);
    }

    public function findUser($id)
    {
        return User::find($id);
    }

    public function updateUser($data, $id)
    {
        // $User = User::where("id", $id)->first();
        // $User->name = $data["name"];
        // $User->status = $data["status"];
        // $User->product_count = $data["product_count"];

        // $User->save();
    }
}
