<?php

namespace App\Strategy;

use App\Strategy\Interfaces\UserAuthStrategy;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EmailAuth implements UserAuthStrategy
{
    public function authenticateUser($email, $password, $remember)
    {
        if (
            Auth::attempt(
                ["email" => $email, "password" => $password],
                $remember
            )
        ) {
            $user = Auth::user();
            return $user;
        }
        return null;
    }
}
