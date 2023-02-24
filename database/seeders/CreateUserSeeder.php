<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                "name" => "User",
                "email" => "use2@gmail.com",
                "password" => bcrypt("123456"),
                "role" => 0,
            ],
            [
                "name" => "Editor",
                "email" => "use3@gmail.com",
                "password" => bcrypt("123456"),
                "role" => 1,
            ],
            [
                "name" => "Admin",
                "email" => "use4@gmail.com",
                "password" => bcrypt("123456"),
                "role" => 2,
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
