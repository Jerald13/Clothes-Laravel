<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Product_images;
class ProductImangesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = Storage::files("public/images/product-detail-01.jpg");

        foreach ($files as $file) {
            $image = file_get_contents(storage_path("app/" . $file));
            Product_images::factory()->create([
                "image" => $image,
            ]);
        }
    }
}
