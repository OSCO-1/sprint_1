<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pkg_Menu\MenuCategory;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data array for all 10 categories
        $categories = [
            [
                'name' => ['fr' => 'Nos Pizzas', 'en' => 'Our Pizzas', 'ar' => 'البيتزا لدينا'],
                'description' => [
                    'fr' => 'Découvrez nos délicieuses pizzas, préparées avec des ingrédients frais et une pâte faite maison.',
                    'en' => 'Discover our delicious pizzas, made with fresh ingredients and homemade dough.',
                    'ar' => 'اكتشف البيتزا اللذيذة لدينا، المحضرة بمكونات طازجة وعجينة مصنوعة يدويًا.'
                ],
                'image_url' => '/categories_seeders/pizzas.jpg',
                'display_order' => 1,
            ],
            [
                'name' => ['fr' => 'Tacos', 'en' => 'Tacos', 'ar' => 'الطاكوس'],
                'description' => [
                    'fr' => 'Des tacos généreusement garnis avec notre fameuse sauce fromagère, pour une expérience inoubliable.',
                    'en' => 'Generously filled tacos with our famous cheese sauce, for an unforgettable experience.',
                    'ar' => 'تاكوس غني بحشوته اللذيذة وصلصة الجبن الشهيرة لتجربة لا تُنسى.'
                ],
                'image_url' => '/categories_seeders/tacos.jpg',
                'display_order' => 2,
            ],
            [
                'name' => ['fr' => 'Shawarma', 'en' => 'Shawarma', 'ar' => 'الشاورما'],
                'description' => [
                    'fr' => 'Le goût authentique du shawarma, mariné aux épices orientales et grillé à la perfection.',
                    'en' => 'The authentic taste of shawarma, marinated in oriental spices and grilled to perfection.',
                    'ar' => 'الطعم الأصيل للشاورما، المتبلة بالبهارات الشرقية والمشوية بإتقان.'
                ],
                'image_url' => '/categories_seeders/shawarma.jpg',
                'display_order' => 3,
            ],
            [
                'name' => ['fr' => 'Nos Burgers', 'en' => 'Our Burgers', 'ar' => 'البرجر لدينا'],
                'description' => [
                    'fr' => 'Des burgers gourmands avec de la viande de qualité et des pains moelleux.',
                    'en' => 'Gourmet burgers with quality meat and soft buns.',
                    'ar' => 'برجر شهي محضر من لحم عالي الجودة وخبز طري.'
                ],
                'image_url' => '/categories_seeders/burgers.jpg',
                'display_order' => 4,
            ],
            [
                'name' => ['fr' => 'Sandwichs & Paninis', 'en' => 'Sandwiches & Paninis', 'ar' => 'الساندويتشات والبانيني'],
                'description' => [
                    'fr' => 'Un large choix de sandwichs et paninis chauds et croustillants pour toutes les faims.',
                    'en' => 'A wide choice of hot and crispy sandwiches and paninis for every appetite.',
                    'ar' => 'تشكيلة واسعة من الساندويتشات والبانيني الساخنة والمقرمشة لجميع الأذواق.'
                ],
                'image_url' => '/categories_seeders/sandwiches.jpg',
                'display_order' => 5,
            ],
            [
                'name' => ['fr' => 'Nos Assiettes', 'en' => 'Our Plates', 'ar' => 'أطباقنا'],
                'description' => [
                    'fr' => 'Des plats complets servis à l\'assiette avec frites et salade fraîche.',
                    'en' => 'Complete dishes served on a plate with fries and fresh salad.',
                    'ar' => 'أطباق متكاملة تقدم مع بطاطس مقلية وسلطة طازجة.'
                ],
                'image_url' => '/categories_seeders/plates.jpg',
                'display_order' => 6,
            ],
            [
                'name' => ['fr' => 'Nos Salades', 'en' => 'Our Salads', 'ar' => 'سلطاتنا'],
                'description' => [
                    'fr' => 'Des salades fraîches et composées pour un repas léger et sain.',
                    'en' => 'Fresh and composed salads for a light and healthy meal.',
                    'ar' => 'سلطات طازجة ومتنوعة لوجبة خفيفة وصحية.'
                ],
                'image_url' => '/categories_seeders/salads.jpg',
                'display_order' => 7,
            ],
            [
                'name' => ['fr' => 'Accompagnements', 'en' => 'Side Dishes', 'ar' => 'المقبلات والمرافقات'],
                'description' => [
                    'fr' => 'Pour compléter votre repas : frites dorées, ailes de poulet et plus encore.',
                    'en' => 'To complete your meal: golden fries, chicken wings, and more.',
                    'ar' => 'لتكمل وجبتك: بطاطس ذهبية، أجنحة دجاج وأكثر.'
                ],
                'image_url' => '/categories_seeders/side.jpg',
                'display_order' => 8,
            ],
            [
                'name' => ['fr' => 'Nos Desserts', 'en' => 'Our Desserts', 'ar' => 'حلوياتنا'],
                'description' => [
                    'fr' => 'Terminez votre repas sur une note sucrée avec nos desserts maison.',
                    'en' => 'Finish your meal on a sweet note with our homemade desserts.',
                    'ar' => 'اختم وجبتك بلمسة حلوة مع حلوياتنا المصنوعة منزليًا.'
                ],
                'image_url' => '/categories_seeders/desserts.jpg',
                'display_order' => 9,
            ],
            [
                'name' => ['fr' => 'Nos Boissons', 'en' => 'Our Drinks', 'ar' => 'مشروباتنا'],
                'description' => [
                    'fr' => 'Une sélection de boissons fraîches, jus et sodas pour étancher votre soif.',
                    'en' => 'A selection of fresh drinks, juices, and sodas to quench your thirst.',
                    'ar' => 'تشكيلة من المشروبات الباردة والعصائر والمياه الغازية لتروي عطشك.'
                ],
                'image_url' => '/categories_seeders/drinks.jpg',
                'display_order' => 10,
            ],
        ];

        // Loop through the data and create the categories
        foreach ($categories as $categoryData) {
            MenuCategory::create(array_merge($categoryData, ['restaurant_id' => 1]));
        }
    }
}
