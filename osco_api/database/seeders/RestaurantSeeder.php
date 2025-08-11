<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pkg_Core\Restaurant;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        Restaurant::create([
            'name' => 'Pizza Palace by Adil',
            'headline' => 'Authentic Wood-Fired Pizza...',
            'description' => 'Welcome to Pizza Palace! The best pizzas in town.',
            'logo_light_theme_url' => 'https://example.com/logo_light.png',
            // Removed 'logo_dark_theme_url'
            'cover_image_url' => 'https://example.com/cover.jpg',
            'phone_number' => '+212600000000',
            'phone_fix' => '+212522222222',          // Added fixed phone number
            'gmail' => 'contact@pizzapalace.ma',    // Added gmail
            'address' => '123 Pizza Street, Casablanca',
            'google_maps_link' => 'https://maps.google.com/?q=Pizza+Palace',
            'opening_hours' => json_encode([
                'mon-fri' => '11:00-23:00',
                'sat-sun' => '12:00-24:00',
            ]),
            'social_links' => json_encode([
                'facebook' => 'https://facebook.com/pizzapalace',
                'instagram' => 'https://instagram.com/pizzapalace',
            ]),
            'currency' => 'MAD',
            // Removed 'primary_color', 'secondary_color', 'settings'
        ]);
    }
}
