<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class transactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("transactions")->insert([
            [
                "amount" => 0.001,
                "txHash" => "0x3594FaD311c9fFE2C1D81b42e0E72971E94d72E7",
            ],
        ]);
    }
}
