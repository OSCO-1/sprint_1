<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('restaurants')->insert([
            [
                'name' => 'Café Ayoub',
                'address' => '123 Boulevard Hassan II, Casablanca',
                'number_phone' => '0522-123456',
                'email' => 'cafe_ayoub@example.com',
                'logo' => 'restaurants/cafe_ayoub.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pizza Marhaba',
                'address' => '456 Rue de la Liberté, Rabat',
                'number_phone' => '0537-654321',
                'email' => 'pizza_marhaba@example.com',
                'logo' => 'restaurants/pizza_marhaba.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Le Gourmet Marrakech',
                'address' => '789 Avenue Mohamed V, Marrakech',
                'number_phone' => '0524-987654',
                'email' => 'le_gourmet@example.com',
                'logo' => 'restaurants/le_gourmet.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
