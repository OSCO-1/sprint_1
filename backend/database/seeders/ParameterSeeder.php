<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parameters')->insert([
            [
                'restaurant_id' => 1,
                'parameter_type' => 'color',
                'name' => 'Primary Color',
                'description' => 'The primary color of the restaurant\'s theme.',
                'primary_color' => '#FF5733',
                'secondary_color' => '#C70039',
                'background_color' => '#FFC300',
                'text_color' => '#581845',
                'font_family' => 'Arial, sans-serif',
                'font_size' => '14px',
                'logo_position' => 'top-left',
                'menu_layout' => 'grid',
                'button_style' => 'rounded',
                'theme_mode' => 'light',
                'custom_css' => '{}', // Valid JSON empty object
                'is_active' => true,
            ],
            [
                'restaurant_id' => 2,
                'parameter_type' => 'font',
                'name' => 'Font Style',
                'description' => 'The font style used in the restaurant\'s menu.',
                'primary_color' => '#333333',
                'secondary_color' => '#666666',
                'background_color' => '#FFFFFF',
                'text_color' => '#000000',
                'font_family' => 'Verdana, sans-serif',
                'font_size' => '16px',
                'logo_position' => 'top-right',
                'menu_layout' => 'list',
                'button_style' => 'flat',
                'theme_mode' => 'dark',
                'custom_css' => '{}', // Valid JSON empty object
                'is_active' => true,
            ],
            [
                'restaurant_id' => 3,
                'parameter_type' => 'layout',
                'name' => 'Menu Layout',
                'description' => 'The layout of the restaurant\'s menu.',
                'primary_color' => '#FF5733',
                'secondary_color' => '#C70039',
                'background_color' => '#FFC300',
                'text_color' => '#581845',
                'font_family' => 'Tahoma, sans-serif',
                'font_size' => '18px',
                'logo_position' => 'center',
                'menu_layout' => 'carousel',
                'button_style' => 'outlined',
                'theme_mode' => 'light',
                'custom_css' => '{}', // Valid JSON empty object
                'is_active' => true,
            ],
            [
                'restaurant_id' => 1,
                'parameter_type' => 'theme',
                'name' => 'Theme Settings',
                'description' => 'Settings for the restaurant\'s theme.',
                'primary_color' => '#FF5733',
                'secondary_color' => '#C70039',
                'background_color' => '#FFC300',
                'text_color' => '#581845',
                'font_family' => 'Courier New, monospace',
                'font_size' => '12px',
                'logo_position' => 'bottom-left',
                'menu_layout' => 'grid',
                'button_style' => 'raised',
                'theme_mode' => 'dark',
                'custom_css' => '{}', // Valid JSON empty object
                'is_active' => true,
            ]
        ]);
    }
}
