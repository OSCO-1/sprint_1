<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pkg_Menu\MenuCategory;

class MenuCategorySeeder extends Seeder
{
    public function run()
    {
        MenuCategory::create([
            'restaurant_id' => 1,
            'name' => [
                'fr' => 'Nos Pizzas',
                'en' => 'Our Pizzas',
                'ar' => 'البيتزا لدينا',
            ],
            'description' => [
                'fr' => 'Toutes nos pizzas sont cuites au feu de bois.',
                'en' => 'All our pizzas are wood-fired.',
                'ar' => 'جميع أنواع البيتزا لدينا تُطهى على الحطب.',
            ],
            'image_url' => 'https://example.com/images/pizzas_category.jpg',
            'display_order' => 1,
        ]);

        MenuCategory::create([
            'restaurant_id' => 1,
            'name' => [
                'fr' => 'Boissons',
                'en' => 'Drinks',
                'ar' => 'مشروبات',
            ],
            'description' => [
                'fr' => 'Boissons fraîches pour accompagner votre repas.',
                'en' => 'Fresh drinks to accompany your meal.',
                'ar' => 'مشروبات باردة لمرافقة وجبتك.',
            ],
            'image_url' => 'https://example.com/images/drinks_category.jpg',
            'display_order' => 2,
        ]);
    }
}
