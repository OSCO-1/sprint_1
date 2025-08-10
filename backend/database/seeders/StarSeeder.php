<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stars')->insert([
            [
                'user_id' => 1,
                'menu_item_id' => 1,
                'rating' => 5,
            ],
            [
                'user_id' => 2,
                'menu_item_id' => 2,
                'rating' => 4,
            ],
            [
                'user_id' => 3,
                'menu_item_id' => 3,
                'rating' => 3,
            ],
            [
                'user_id' => 4,
                'menu_item_id' => 4,
                'rating' => 2,
            ],
            [
                'user_id' => 5,
                'menu_item_id' => 5,
                'rating' => 1,
            ],
        ]);
    }
}
