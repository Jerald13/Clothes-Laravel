<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    //php artisan db:seed

    public function run()
    {
        $this->call([
            CreateUserSeeder::class,
            ProductImangesSeeder::class,
            CategorySeeder::class,
            SizeSeeder::class,
            ProductSeeder::class,
            StockSeeder::class,
            CartSeeder::class,
            // add any other seeders you have here
        ]);
    }
}
