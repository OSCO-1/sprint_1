<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_items')->insert([
            [
                'order_id' => 1,
                'menu_item_id' => 1,
                'quantity' => 2,
                'price' => 10.00,
            ],
            [
                'order_id' => 1,
                'menu_item_id' => 2,
                'quantity' => 1,
                'price' => 15.00,
            ],
            [
                'order_id' => 3,
                'menu_item_id' => 3,
                'quantity' => 3,
                'price' => 5.00,
            ],
        ]);
    }
}
