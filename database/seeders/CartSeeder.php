<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("cart")->insert([
            [
                "product_id" => "1",
                "user_id" => "1",
                "user_quantity" => "1",
                "user_color" => "Black",
                "user_size" => "XS",
                "created_at" => Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at" => Carbon::now()->format("Y-m-d H:i:s"),
            ],
            [
                "product_id" => "1",
                "user_id" => "2",
                "user_quantity" => "1",
                "user_color" => "White",
                "user_size" => "S",
                "created_at" => Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at" => Carbon::now()->format("Y-m-d H:i:s"),
            ],
        ]);
    }
}
