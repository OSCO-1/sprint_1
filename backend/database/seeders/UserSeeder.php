<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'restaurant_id' => 1,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => bcrypt('password'),
            ],
            [
                'restaurant_id' => 1,
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => bcrypt('password'),
            ],
            [
                'restaurant_id' => 1,
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'password' => bcrypt('password'),
            ],
            [
                'restaurant_id' => 1,
                'name' => 'Alice Brown',
                'email' => 'alice@example.com',
                'password' => bcrypt('password'),
            ],
        ]);
    }
}
