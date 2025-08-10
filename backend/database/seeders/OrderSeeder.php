<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'table_id' => 1,
                'restaurant_id' => 1,
                'total_price' => 120.50,
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'table_id' => 2,
                'restaurant_id' => 1,
                'total_price' => 45.00,
                'status' => 'preparing',
                'created_at' => Carbon::now()->subMinutes(30),
                'updated_at' => Carbon::now()->subMinutes(20),
            ],
            [
                'table_id' => 3,
                'restaurant_id' => 2,
                'total_price' => 89.90,
                'status' => 'served',
                'created_at' => Carbon::now()->subHour(),
                'updated_at' => Carbon::now()->subMinutes(40),
            ]
        ]);
    }
}
