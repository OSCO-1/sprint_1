<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menu_categories')->insert([
            [
                'restaurant_id' => 1, // Assuming restaurant_id 1 exists
                'name' => 'Appetizers',
                'description' => 'Start your meal with our delicious appetizers.',
                'image' => 'appetizers.jpg',
            ],
            [
                'restaurant_id' => 2,
                'name' => 'Main Courses',
                'description' => 'Satisfy your hunger with our main courses.',
                'image' => 'main_courses.jpg',
            ],
            [
                'restaurant_id' => 3,
                'name' => 'Desserts',
                'description' => 'Indulge in our sweet desserts.',
                'image' => 'desserts.jpg',
            ],
            [
                'restaurant_id' => 1,
                'name' => 'Beverages',
                'description' => 'Quench your thirst with our beverages.',
                'image' => 'beverages.jpg',
            ],
            [
                'restaurant_id' => 2,
                'name' => 'Salads',
                'description' => 'Fresh and healthy salads to complement your meal.',
                'image' => 'salads.jpg',
            ],
            [
                'restaurant_id' => 3,
                'name' => 'Soups',
                'description' => 'Warm and comforting soups for every season.',
                'image' => 'soups.jpg',
            ],
            [ 
               'restaurant_id' => 1,
                'name' => 'Pizzas',
                'description' => 'Delicious pizzas with a variety of toppings.',
                'image' => 'pizzas.jpg',
            ],
            [
                'restaurant_id' => 2,
                'name' => 'Pastas',
                'description' => 'Tasty pastas cooked to perfection.',
                'image' => 'pastas.jpg',
            ],
        ]);
    }
}
