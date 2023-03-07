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
                "username" => "JR",
                "email" => "clotheslaravel@gmail.com",
                "phone_number" => "+60182055007",
                "password" => bcrypt("123456"),
                "role" => 0,
            ],
            [
                "name" => "Editor",
                "username" => "Lit",
                "email" => "jeraldlee2002@gmail.com",
                "phone_number" => "+60182055007",

                "password" => bcrypt("123456"),
                "role" => 1,
            ],
            [
                "name" => "Admin",
                "username" => "PowerGuy",
                "email" => "leeszeyen13@gmail.com",
                "phone_number" => "+60182055007",

                "password" => bcrypt("123456"),
                "role" => 2,
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
