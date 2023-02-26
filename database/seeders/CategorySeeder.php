<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("category")->insert([
            [
                "name" => "Women",
                "status" => "active",
            ],
            [
                "name" => "Men",
                "status" => "active",
            ],
            [
                "name" => "Bag",
                "status" => "active",
            ],
            // [
            //     "name" => "Shoes",
            //     "status" => "active",
            // ],
            // [
            //     "name" => "Watches",
            //     "status" => "active",
            // ],
        ]);
    }
}
