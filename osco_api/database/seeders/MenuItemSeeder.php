<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pkg_Menu\MenuItem;

class MenuItemSeeder extends Seeder
{
    public function run()
    {
        // Example items
        MenuItem::create([
            'restaurant_id' => 1,
            'menu_category_id' => 1,
            'name' => [
                'fr' => 'Pizza Royale',
                'en' => 'Royal Pizza',
                'ar' => 'بيتزا رويال',
            ],
            'description' => [
                'fr' => 'Sauce tomate, fromage, dinde...',
                'en' => 'Tomato sauce, cheese, turkey...',
                'ar' => 'صلصة طماطم، جبن، ديك رومي...',
            ],
            'image_url' => 'https://example.com/images/pizza_royale.jpg',
            'base_price' => 75.00,
            'is_available' => true,
        ]);

        MenuItem::create([
            'restaurant_id' => 1,
            'menu_category_id' => 2,
            'name' => [
                'fr' => 'Coca-Cola',
                'en' => 'Coca-Cola',
                'ar' => 'كوكا كولا',
            ],
            'description' => [
                'fr' => '33cl',
                'en' => '33cl',
                'ar' => '33 سنتيلتر',
            ],
            'image_url' => 'https://example.com/images/coca_cola.jpg',
            'base_price' => 15.00,
            'is_available' => true,
        ]);
    }
}
