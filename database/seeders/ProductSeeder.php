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
                "price" => "16.64",
                "description" =>
                   "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "1",
                "gallery" =>
                    "images/product-01.jpg",
            ],
            [
                "name" => "Herschel supply",
                "price" => "35.31",
                "description" =>
                    "Good Nice T",
                "category" => "1",
                "gallery" =>
                    "images/product-02.jpg",
            ],
            [
                "name" => "Only Check Trouser",
                "price" => "25.50",
                "description" =>
                    "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "2",
                "gallery" =>
                    "images/product-03.jpg",
            ],
            [
                "name" => "Classic Trench Coat",
                "price" => "75.00",
                "description" =>
                    "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "1",
                "gallery" =>
                    "images/product-04.jpg",
            ],
            [
                "name" => "Front Pocket Jumper",
                "price" => "34.75",
                "description" =>
                    "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "1",
                "gallery" =>
                    "images/product-05.jpg",
            ],
            [
                "name" => "Vintage Inspired Classic",
                "price" => "93.20",
                "description" =>
                    "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "5",
                "gallery" =>
                    "images/product-06.jpg",
            ],
            [
                "name" => "Shirt in Stretch Cotton",
                "price" => "63.16",
                "description" =>
                    "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "1",
                "gallery" =>
                    "images/product-07.jpg",
            ],
            [
                "name" => "Pieces Metallic Printed",
                "price" => "18.96",
                "description" =>
                   "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "1",
                "gallery" =>
                    "images/product-08.jpg",
            ],
            [
                "name" => "Converse All Star Hi Plimsolls",
                "price" => "75.00",
                "description" =>
                    "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "4",
                "gallery" =>
                    "images/product-09.jpg",
            ],
            [
                "name" => "Femme T-Shirt In Stripe",
                "price" => "25.85",
                "description" =>
                   "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "1",
                "gallery" =>
                    "images/product-10.jpg",
            ],
            [
                "name" => "Herschel supply 2",
                "price" => "63.15",
                "description" =>
                    "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "2",
                "gallery" =>
                    "images/product-11.jpg",
            ],
            [
                "name" => "Herschel supply 3",
                "price" => "38.55",
                "description" =>
                   "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "2",
                "gallery" =>
                    "images/product-12.jpg",
            ],
            [
                "name" => "T-Shirt with Sleeve",
                "price" => "18.49",
                "description" =>
                   "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "1",
                "gallery" =>
                    "images/product-13.jpg",
            ],
            [
                "name" => "Pretty Little Thing",
                "price" => "54.79",
                "description" =>
                    "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "1",
                "gallery" =>
                    "images/product-14.jpg",
            ],
            [
                "name" => "Mini Silver Mesh Watch",
                "price" => "86.85",
                "description" =>
                   "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "5",
                "gallery" =>
                    "images/product-15.jpg",
            ],
            [
                "name" => "quare Neck Back",
                "price" => "29.64",
                "description" =>
                   "Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.",
                "category" => "1",
                "gallery" =>
                    "images/product-16.jpg",
            ]


        ]);
    }
}
