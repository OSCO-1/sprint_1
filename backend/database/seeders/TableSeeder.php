<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed the tables
        FacadesDB::table('tables')->insert([
            [
                'restaurant_id' => 1,
                'table_number' => 1,
                'qr_url' => 'https://example.com/qr/1'
            ],
            [
                'restaurant_id' => 2,
                'table_number' => 2,
                'qr_url' => 'https://example.com/qr/2'
            ],
            [
                'restaurant_id' => 3,
                'table_number' => 3,
                'qr_url' => 'https://example.com/qr/3'
            ],
            [
                'restaurant_id' => 1,
                'table_number' => 4,
                'qr_url' => 'https://example.com/qr/4'
            ],
        ]);
    }
}
