<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Laravel\Prompts\table;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menu_items')->insert([
            [
                'restaurant_id' => 1,
                'name' => 'Pizza',
                'description' => 'Delicious cheese pizza',
                'image' => 'pizza.jpg',
                'price' => 9.99,
                'menu_category_id' => 1
            ],
            [
                'restaurant_id' => 2,
                'name' => 'Burger',
                'description' => 'Juicy beef burger',
                'image' => 'burger.jpg',
                'price' => 8.99,
                'menu_category_id' => 1
            ],
            [
                'restaurant_id' => 3,
                'name' => 'Pasta',
                'description' => 'Creamy Alfredo pasta',
                'image' => 'pasta.jpg',
                'price' => 12.99,
                'menu_category_id' => 2
            ],
            [
                'restaurant_id' => 1,
                'name' => 'Salad',
                'description' => 'Fresh garden salad',
                'image' => 'salad.jpg',
                'price' => 7.99,
                'menu_category_id' => 2
            ],
            [
                'restaurant_id' => 2,
                'name' => 'Ice Cream',
                'description' => 'Vanilla ice cream with chocolate sauce',
                'image' => 'ice_cream.jpg',
                'price' => 4.99,
                'menu_category_id' => 3
            ],
            [
                'restaurant_id' => 3,
                'name' => 'Soda',
                'description' => 'Refreshing cola drink',
                'image' => 'soda.jpg',
                'price' => 1.99,
                'menu_category_id' => 4
            ]
        ]);
    }
}
