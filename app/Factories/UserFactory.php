<?php

namespace App\Factories;

use App\Models\Admin;
use App\Models\Editor;
use App\Models\User;

class UserFactory
{
    public static function createUser(array $validatedData)
    {
        $role = $validatedData["name"] ?? "User";

        switch ($role) {
            case "Admin":
                $validatedData["name"] = "Admin";
                $validatedData["role"] = 2;
                break;
            case "Editor":
                $validatedData["name"] = "Editor";
                $validatedData["role"] = 1;
                break;
            default:
                break;
        }

        return User::create($validatedData);
    }

    public static function getRole(array $validatedData)
    {
        $role = $validatedData["name"] ?? "User";

        switch ($role) {
            case "Admin":
                return 2;
            case "Editor":
                return 1;
            default:
                return 0;
        }
    }
}
