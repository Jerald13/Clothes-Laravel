<?php
namespace App\Strategy;
use App\Strategy\Interfaces\UserAuthStrategy;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsernameAuth implements UserAuthStrategy
{
    public function authenticateUser($username, $password, $remember)
    {
        if (
            Auth::attempt(
                ["username" => $username, "password" => $password],
                $remember
            )
        ) {
            $user = Auth::user();
            return $user;
        }
    }
}
