<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdditionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('additionals')->insert([
            [
                'restaurant_id' => 1,
                'menu_item_id' => 1,
                'name' => 'Extra Cheese',
                'price' => 1.50,
                'available' => true
            ],
            [
                'restaurant_id' => 2,
                'menu_item_id' => 2,
                'name' => 'Bacon',
                'price' => 2.00,
                'available' => true
            ],
            [
                'restaurant_id' => 3,
                'menu_item_id' => 3,
                'name' => 'Spicy Sauce',
                'price' => 0.75,
                'available' => true
            ],
            [
                'restaurant_id' => 1,
                'menu_item_id' => 4,
                'name' => 'Avocado',
                'price' => 1.25,
                'available' => true
            ],
        ]);
    }
}
