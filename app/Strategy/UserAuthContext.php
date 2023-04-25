<?php
namespace App\Strategy;
use App\Strategy\Interfaces\UserAuthStrategy;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserAuthContext
{
    private $strategy;

    public function __construct(UserAuthStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function authenticateUser($email, $password, $remember)
    {
        return $this->strategy->authenticateUser($email, $password, $remember);
    }
}
