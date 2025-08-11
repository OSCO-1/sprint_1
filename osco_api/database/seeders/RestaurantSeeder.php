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
            'cover_image_url' => 'https://example.com/cover.jpg',
            'phone_number' => '+212600000000',
            'phone_fix' => '+212522222222',
            'gmail' => 'contact@pizzapalace.ma',
            'address' => '123 Pizza Street, Casablanca',
            'google_maps_link' => 'https://maps.google.com/?q=Pizza+Palace',
            'facebook' => 'https://facebook.com/pizzapalace',
            'instagram' => 'https://instagram.com/pizzapalace',
            'youtube' => 'https://youtube.com/pizzapalace',
            'snapchat' => 'https://snapchat.com/add/pizzapalace',
            'tiktok' => 'https://tiktok.com/@pizzapalace',
            'currency' => 'MAD',
        ]);
    }
}
