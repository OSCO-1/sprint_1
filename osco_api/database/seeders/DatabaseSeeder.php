<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed the main restaurant first
        $this->call(RestaurantSeeder::class);

        // Seed the user(s) related to the restaurant
        $this->call(UserSeeder::class);

        // Seed the menu categories
        $this->call(MenuCategorySeeder::class);

        // Seed the menu items
        $this->call(MenuItemSeeder::class);

        // Optional: You can uncomment below to create additional test users via factory
        // \App\Models\User::factory(10)->create();
    }
}
