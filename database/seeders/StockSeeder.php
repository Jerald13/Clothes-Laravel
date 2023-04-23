<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("stock")->insert([
            [
                "color_id" => "1",
                "size_id" => "1",
                "product_id" => "1",
                "quantity" => "10",
                "created_at" => Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at" => Carbon::now()->format("Y-m-d H:i:s"),
            ],
            [
                "color_id" => "2",
                "size_id" => "1",
                "product_id" => "1",
                "quantity" => "10",
                "created_at" => Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at" => Carbon::now()->format("Y-m-d H:i:s"),
            ],
            [
                "color_id" => "3",
                "size_id" => "1",
                "product_id" => "1",
                "quantity" => "1",
                "created_at" => Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at" => Carbon::now()->format("Y-m-d H:i:s"),
            ],
            [
                "color_id" => "4",
                "size_id" => "1",
                "product_id" => "1",
                "quantity" => "1",
                "created_at" => Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at" => Carbon::now()->format("Y-m-d H:i:s"),
            ],
            [
                "color_id" => "5",
                "size_id" => "1",
                "product_id" => "1",
                "quantity" => "1",
                "created_at" => Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at" => Carbon::now()->format("Y-m-d H:i:s"),
            ],
        ]);
    }
}
