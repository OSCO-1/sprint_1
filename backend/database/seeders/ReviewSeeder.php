<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'restaurant_id' => 1,
                'user_id' => 1,
                'order_id' => 1,
                'comment' => 'Great food and service!',
                'rating' => 5,
            ],
            [
                'restaurant_id' => 2,
                'user_id' => 2,
                'order_id' => 2,
                'comment' => 'Average experience, could be better.',
                'rating' => 3,
            ],
            [
                'restaurant_id' => 3,
                'user_id' => 3,
                'order_id' => 3,
                'comment' => 'Loved the ambiance and food quality!',
                'rating' => 4,
            ],
            // [
            //     'restaurant_id' => 1,
            //     'user_id' => 4,
            //     'order_id' => 3,
            //     'comment' => 'Not worth the price, very disappointed.',
            //     'rating' => 2,
            // ],
            // [
            //     'restaurant_id' => 2,
            //     'user_id' => 5,
            //     'order_id' => 3,
            //     'comment' => 'Excellent service, will come back again!',
            //     'rating' => 5,
            // ],
            // [
            //     'restaurant_id' => 3,
            //     'user_id' => 6,
            //     'order_id' => 2,
            //     'comment' => 'Food was cold and not fresh.',
            //     'rating' => 1,
            // ],
        ]);
    }
}
