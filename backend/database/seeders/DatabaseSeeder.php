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
        // User::factory(10)->create();
        $this->call([RestaurantSeeder::class]);
        $this->call([UserSeeder::class]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([MenuCategorySeeder::class]);
        $this->call([MenuItemSeeder::class]);
        $this->call([TableSeeder::class]);
        $this->call([OrderSeeder::class]);
        $this->call([OrderItemSeeder::class]);
        $this->call([ParameterSeeder::class]);
        $this->call([AdditionalSeeder::class]);
        $this->call([StarSeeder::class]);
        $this->call([ReviewSeeder::class]);
    }
}
