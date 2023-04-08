<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("products")->insert([
            [
                "name" => "Esprit Ruffle Shirt",
                "category_id" => "1",
                "price" => "16.64",
                "size" => "1",
                "color" => "red",
                "quantity" => "12",
                "description" =>
                    "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
            ],
            [
                "name" => "Esprit Ruffle ShirtAA",
                "category_id" => "1",
                "price" => "16.64",
                "size" => "1",
                "color" => "red",
                "quantity" => "12",
                "description" =>
                    "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
            ],
        ]);
    }
}
