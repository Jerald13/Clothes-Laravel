<?php
namespace App\Strategy\Interfaces;

interface UserAuthStrategy
{
    public function authenticateUser($email, $password, $remember);
}
