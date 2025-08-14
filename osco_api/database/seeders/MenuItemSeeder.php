<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pkg_Menu\MenuItem;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuItems = [
            // =========================================================================
            // CATEGORY 1: PIZZAS
            // =========================================================================
            [
                // ================== Pizza Margherita ==================
                'menu_category_id' => 1,
                'name' => ['fr' => 'Pizza Margherita', 'en' => 'Margherita Pizza', 'ar' => 'بيتزا مارغريتا'],
                'description' => ['fr' => 'La classique intemporelle : sauce tomate, mozzarella fondante et une touche d\'origan.', 'en' => 'The timeless classic: tomato sauce, melted mozzarella, and a touch of oregano.', 'ar' => 'الكلاسيكية الخالدة: صلصة طماطم، جبن موزاريلا ذائب، ورشة من الأوريغانو.'],
                'image_url' => '/menuItems_seeders/pizzas/margherita.jpg',
                'base_price' => 60.00,
            ],
            [
                // ================== Pizza Reine ==================
                'menu_category_id' => 1,
                'name' => ['fr' => 'Pizza Reine', 'en' => 'Queen Pizza', 'ar' => 'بيتزا رين'],
                'description' => ['fr' => 'Une combinaison royale de dinde fumée et de champignons frais sur une base de mozzarella.', 'en' => 'A royal combination of smoked turkey and fresh mushrooms on a mozzarella base.', 'ar' => 'مزيج ملكي من الديك الرومي المدخن والفطر الطازج على قاعدة من الموزاريلا.'],
                'image_url' => '/menuItems_seeders/pizzas/reine.jpg',
                'base_price' => 75.00,
            ],
            [
                // ================== Pizza Neptune ==================
                'menu_category_id' => 1,
                'name' => ['fr' => 'Pizza Neptune', 'en' => 'Neptune Pizza', 'ar' => 'بيتزا نبتون'],
                'description' => ['fr' => 'Une saveur de l\'océan avec du thon généreux et des olives noires piquantes.', 'en' => 'A taste of the ocean with generous tuna and zesty black olives.', 'ar' => 'نكهة من المحيط مع كمية سخية من التونة والزيتون الأسود اللذيذ.'],
                'image_url' => '/menuItems_seeders/pizzas/neptune.jpg',
                'base_price' => 70.00,
            ],
            [
                // ================== Pizza Kefta ==================
                'menu_category_id' => 1,
                'name' => ['fr' => 'Pizza Kefta', 'en' => 'Kefta Pizza', 'ar' => 'بيتزا الكفتة'],
                'description' => ['fr' => 'Une spécialité locale riche en saveurs avec de la viande hachée (kefta) savoureuse et des oignons.', 'en' => 'A flavorful local specialty with savory ground meat (kefta) and onions.', 'ar' => 'تخصص محلي غني بالنكهات مع اللحم المفروم (الكفتة) الشهي والبصل.'],
                'image_url' => '/menuItems_seeders/pizzas/kefta.jpg',
                'base_price' => 80.00,
            ],
            [
                // ================== Pizza 4 Saisons ==================
                'menu_category_id' => 1,
                'name' => ['fr' => 'Pizza 4 Saisons', 'en' => '4 Seasons Pizza', 'ar' => 'بيتزا الفصول الأربعة'],
                'description' => ['fr' => 'Un festin pour les yeux et le palais : champignons, dinde, poivrons et olives.', 'en' => 'A feast for the eyes and palate: mushrooms, turkey, peppers, and olives.', 'ar' => 'مهرجان للعيون والذوق: فطر، ديك رومي، فلفل، وزيتون.'],
                'image_url' => '/menuItems_seeders/pizzas/4saisons.jpg',
                'base_price' => 85.00,
            ],
            [
                // ================== Pizza Végétarienne ==================
                'menu_category_id' => 1,
                'name' => ['fr' => 'Pizza Végétarienne', 'en' => 'Vegetarian Pizza', 'ar' => 'بيتزا نباتية'],
                'description' => ['fr' => 'Une abondance de légumes frais du marché : champignons, poivrons, oignons et olives.', 'en' => 'An abundance of fresh market vegetables: mushrooms, peppers, onions, and olives.', 'ar' => 'وفرة من خضروات السوق الطازجة: فطر، فلفل، بصل، وزيتون.'],
                'image_url' => '/menuItems_seeders/pizzas/vegetarienne.jpg',
                'base_price' => 65.00,
            ],
            [
                // ================== Pizza 4 Fromages ==================
                'menu_category_id' => 1,
                'name' => ['fr' => 'Pizza 4 Fromages', 'en' => '4 Cheeses Pizza', 'ar' => 'بيتزا الأجبان الأربعة'],
                'description' => ['fr' => 'Le paradis des amateurs de fromage : un mélange crémeux de mozzarella, chèvre, bleu et edam.', 'en' => 'A cheese lover\'s paradise: a creamy blend of mozzarella, goat, blue, and edam cheese.', 'ar' => 'جنة عشاق الجبن: مزيج كريمي من جبن الموزاريلا، الماعز، الجبن الأزرق، والإيدام.'],
                'image_url' => '/menuItems_seeders/pizzas/4fromages.jpg',
                'base_price' => 85.00,
            ],
            [
                // ================== Pizza Poulet ==================
                'menu_category_id' => 1,
                'name' => ['fr' => 'Pizza au Poulet', 'en' => 'Chicken Pizza', 'ar' => 'بيتزا الدجاج'],
                'description' => ['fr' => 'De tendres morceaux de poulet mariné, accompagnés de poivrons colorés et de fromage fondant.', 'en' => 'Tender pieces of marinated chicken, accompanied by colorful peppers and melted cheese.', 'ar' => 'قطع طرية من الدجاج المتبل، مع الفلفل الملون والجبن الذائب.'],
                'image_url' => '/menuItems_seeders/pizzas/poulet.jpg',
                'base_price' => 80.00,
            ],

            // =========================================================================
            // CATEGORY 2: TACOS
            // =========================================================================
            [
                // ================== Taco Poulet ==================
                'menu_category_id' => 2,
                'name' => ['fr' => 'Taco au Poulet', 'en' => 'Chicken Taco', 'ar' => 'طاكوس بالدجاج'],
                'description' => ['fr' => 'Tendres morceaux de poulet mariné, frites croustillantes et notre fameuse sauce fromagère.', 'en' => 'Tender pieces of marinated chicken, crispy fries, and our famous cheese sauce.', 'ar' => 'قطع طرية من الدجاج المتبل، بطاطس مقرمشة، وصلصتنا الجبنية الشهيرة.'],
                'image_url' => '/menuItems_seeders/tacos/poulet.jpg',
                'base_price' => 35.00,
            ],
            [
                // ================== Taco Kefta ==================
                'menu_category_id' => 2,
                'name' => ['fr' => 'Taco à la Kefta', 'en' => 'Kefta Taco', 'ar' => 'طاكوس بالكفتة'],
                'description' => ['fr' => 'Viande hachée (kefta) savoureuse, frites dorées et notre onctueuse sauce fromagère.', 'en' => 'Savory ground meat (kefta), golden fries, and our creamy cheese sauce.', 'ar' => 'لحم مفروم (كفتة) لذيذ، بطاطس ذهبية، وصلصتنا الجبنية الكريمية.'],
                'image_url' => '/menuItems_seeders/tacos/kefta.jpg',
                'base_price' => 40.00,
            ],
            [
                // ================== Taco Cordon Bleu ==================
                'menu_category_id' => 2,
                'name' => ['fr' => 'Taco Cordon Bleu', 'en' => 'Cordon Bleu Taco', 'ar' => 'طاكوس كوردون بلو'],
                'description' => ['fr' => 'Un classique réinventé : escalope de poulet farcie au fromage et à la dinde fumée.', 'en' => 'A reinvented classic: breaded chicken cutlet stuffed with cheese and smoked turkey.', 'ar' => 'كلاسيكية مبتكرة: إسكالوب دجاج محشو بالجبن والديك الرومي المدخن.'],
                'image_url' => '/menuItems_seeders/tacos/cordonbleu.jpg',
                'base_price' => 45.00,
            ],
            [
                // ================== Taco Mixte ==================
                'menu_category_id' => 2,
                'name' => ['fr' => 'Taco Mixte', 'en' => 'Mixed Taco', 'ar' => 'طاكوس مختلط'],
                'description' => ['fr' => 'Le meilleur des deux mondes : choisissez deux viandes, avec frites et sauce fromagère.', 'en' => 'The best of both worlds: choose two meats, with fries and cheese sauce.', 'ar' => 'أفضل ما في العالمين: اختر نوعين من اللحوم، مع البطاطس المقلية وصلصة الجبن.'],
                'image_url' => '/menuItems_seeders/tacos/mixte.jpg',
                'base_price' => 45.00,
            ],
            [
                // ================== Taco Végétarien ==================
                'menu_category_id' => 2,
                'name' => ['fr' => 'Taco Végétarien', 'en' => 'Vegetarian Taco', 'ar' => 'طاكوس نباتي'],
                'description' => ['fr' => 'Une délicieuse galette de légumes, frites dorées et notre sauce fromagère.', 'en' => 'A delicious vegetable patty, golden fries, and our cheese sauce.', 'ar' => 'فطيرة خضروات لذيذة، بطاطس ذهبية وصلصتنا الجبنية.'],
                'image_url' => '/menuItems_seeders/tacos/vegetarien.jpg',
                'base_price' => 30.00,
            ],
            [
                // ================== Taco Merguez ==================
                'menu_category_id' => 2,
                'name' => ['fr' => 'Taco au Merguez', 'en' => 'Merguez Taco', 'ar' => 'طاكوس بالمرقاز'],
                'description' => ['fr' => 'Des saucisses merguez épicées pour un taco plein de caractère, avec frites et sauce fromagère.', 'en' => 'Spicy merguez sausages for a taco full of character, with fries and cheese sauce.', 'ar' => 'نقانق المرقاز الحارة لطاكوس ذو طابع قوي، مع البطاطس المقلية وصلصة الجبن.'],
                'image_url' => '/menuItems_seeders/tacos/merguez.jpg',
                'base_price' => 40.00,
            ],
            [
                // ================== Taco Suprême ==================
                'menu_category_id' => 2,
                'name' => ['fr' => 'Taco Suprême', 'en' => 'Supreme Taco', 'ar' => 'طاكوس سوبريم'],
                'description' => ['fr' => 'Pour les très grandes faims : deux viandes au choix, extra fromage et notre sauce signature.', 'en' => 'For the very hungry: two meats of your choice, extra cheese, and our signature sauce.', 'ar' => 'للشهية الكبيرة جداً: نوعان من اللحوم من اختيارك، جبن إضافي، وصلصتنا الخاصة.'],
                'image_url' => '/menuItems_seeders/tacos/supreme.jpg',
                'base_price' => 55.00,
            ],

            // =========================================================================
            // CATEGORY 3: SHAWARMA
            // =========================================================================
            [
                // ================== Sandwich Shawarma ==================
                'menu_category_id' => 3,
                'name' => ['fr' => 'Sandwich Shawarma', 'en' => 'Shawarma Sandwich', 'ar' => 'ساندويتش شاورما'],
                'description' => ['fr' => 'Viande de shawarma authentique, marinée et grillée, servie dans un pain libanais avec salade, cornichons et notre fameuse sauce à l\'ail.', 'en' => 'Authentic marinated and grilled shawarma meat, served in Lebanese bread with salad, pickles, and our famous garlic sauce.', 'ar' => 'لحم شاورما أصلي، متبل ومشوي، يقدم في خبز لبناني مع سلطة، مخلل، وصلصتنا الشهيرة بالثوم.'],
                'image_url' => '/menuItems_seeders/shawarma/sandwich.jpg',
                'base_price' => 30.00,
            ],
            [
                // ================== Tacos Shawarma ==================
                'menu_category_id' => 3,
                'name' => ['fr' => 'Tacos Shawarma', 'en' => 'Shawarma Taco', 'ar' => 'طاكوس شاورما'],
                'description' => ['fr' => 'La rencontre de deux mondes : la saveur du shawarma dans un tacos français, avec frites et sauce fromagère.', 'en' => 'The meeting of two worlds: the flavor of shawarma in a French taco, with fries and cheese sauce.', 'ar' => 'لقاء عالمين: نكهة الشاورما في طاكوس فرنسي، مع بطاطس مقلية وصلصة الجبن.'],
                'image_url' => '/menuItems_seeders/shawarma/tacos.jpg',
                'base_price' => 38.00,
            ],

            // =========================================================================
            // CATEGORY 4: BURGERS
            // =========================================================================
            [
                // ================== Classic Burger ==================
                'menu_category_id' => 4,
                'name' => ['fr' => 'Classic Burger', 'en' => 'Classic Burger', 'ar' => 'برجر كلاسيك'],
                'description' => ['fr' => 'L\'indémodable : steak haché de qualité, salade, tomate, oignon et notre sauce burger secrète.', 'en' => 'The timeless one: quality ground steak, lettuce, tomato, onion, and our secret burger sauce.', 'ar' => 'الكلاسيكي الذي لا يمل منه: شريحة لحم عالية الجودة، خس، طماطم، بصل، وصلصتنا السرية.'],
                'image_url' => '/menuItems_seeders/burgers/classic.jpg',
                'base_price' => 35.00,
            ],
            [
                // ================== Cheeseburger ==================
                'menu_category_id' => 4,
                'name' => ['fr' => 'Cheeseburger', 'en' => 'Cheeseburger', 'ar' => 'تشيز برجر'],
                'description' => ['fr' => 'Le plaisir gourmand : steak haché, fromage cheddar fondant, salade et cornichons.', 'en' => 'The gourmet pleasure: ground steak, melted cheddar cheese, lettuce, and pickles.', 'ar' => 'المتعة الشهية: شريحة لحم، جبن شيدر ذائب، خس، ومخلل.'],
                'image_url' => '/menuItems_seeders/burgers/cheeseburger.jpg',
                'base_price' => 40.00,
            ],
            [
                // ================== Chicken Burger ==================
                'menu_category_id' => 4,
                'name' => ['fr' => 'Chicken Burger', 'en' => 'Chicken Burger', 'ar' => 'برجر الدجاج'],
                'description' => ['fr' => 'Un filet de poulet croustillant et tendre, accompagné de salade fraîche et d\'une mayonnaise onctueuse.', 'en' => 'A crispy and tender chicken fillet, accompanied by fresh lettuce and creamy mayonnaise.', 'ar' => 'فيليه دجاج مقرمش وطري، مع الخس الطازج والمايونيز الكريمي.'],
                'image_url' => '/menuItems_seeders/burgers/chicken.jpg',
                'base_price' => 38.00,
            ],
            [
                // ================== Double Burger ==================
                'menu_category_id' => 4,
                'name' => ['fr' => 'Double Burger', 'en' => 'Double Burger', 'ar' => 'دبل برجر'],
                'description' => ['fr' => 'Pour les vrais amateurs : deux steaks hachés, double fromage, et double plaisir.', 'en' => 'For true lovers: two ground steaks, double cheese, and double pleasure.', 'ar' => 'للعشاق الحقيقيين: شريحتا لحم، جبن مضاعف، ومتعة مضاعفة.'],
                'image_url' => '/menuItems_seeders/burgers/double.jpg',
                'base_price' => 55.00,
            ],
            [
                // ================== Maison Burger ==================
                'menu_category_id' => 4,
                'name' => ['fr' => 'Burger Maison', 'en' => 'House Burger', 'ar' => 'برجر منزلي'],
                'description' => ['fr' => 'Notre création signature : steak haché, fromage, œuf, oignons caramélisés et notre sauce spéciale.', 'en' => 'Our signature creation: ground steak, cheese, egg, caramelized onions, and our special sauce.', 'ar' => 'إبداعنا الخاص: شريحة لحم، جبن، بيض، بصل مكرمل، وصلصتنا الخاصة.'],
                'image_url' => '/menuItems_seeders/burgers/maison.jpg',
                'base_price' => 50.00,
            ],

            // =========================================================================
            // CATEGORY 5: SANDWICHES & PANINIS
            // =========================================================================
            [
                // ================== Panini Poulet ==================
                'menu_category_id' => 5,
                'name' => ['fr' => 'Panini au Poulet', 'en' => 'Chicken Panini', 'ar' => 'بانيني بالدجاج'],
                'description' => ['fr' => 'Poulet grillé tendre et mozzarella fondante, pressés à chaud dans un pain panini croustillant.', 'en' => 'Tender grilled chicken and melted mozzarella, hot-pressed in a crispy panini bread.', 'ar' => 'دجاج مشوي طري وجبن موزاريلا ذائب، مضغوط على الساخن في خبز بانيني مقرمش.'],
                'image_url' => '/menuItems_seeders/sandwiches/panini_poulet.jpg',
                'base_price' => 35.00,
            ],
            [
                // ================== Panini Kefta ==================
                'menu_category_id' => 5,
                'name' => ['fr' => 'Panini à la Kefta', 'en' => 'Kefta Panini', 'ar' => 'بانيني بالكفتة'],
                'description' => ['fr' => 'La richesse de la kefta marocaine avec du fromage fondant, le tout dans un panini grillé.', 'en' => 'The richness of Moroccan kefta with melted cheese, all in a grilled panini.', 'ar' => 'غنى الكفتة المغربية مع الجبن الذائب، الكل في بانيني مشوي.'],
                'image_url' => '/menuItems_seeders/sandwiches/panini_kefta.jpg',
                'base_price' => 38.00,
            ],
            [
                // ================== Panini Thon Fromage ==================
                'menu_category_id' => 5,
                'name' => ['fr' => 'Panini Thon Fromage', 'en' => 'Tuna Cheese Panini', 'ar' => 'بانيني بالتونة والجبن'],
                'description' => ['fr' => 'Un classique réconfortant : thon, mozzarella et une touche de tomate fraîche.', 'en' => 'A comforting classic: tuna, mozzarella, and a touch of fresh tomato.', 'ar' => 'كلاسيكية تبعث على الراحة: تونة، موزاريلا، ولمسة من الطماطم الطازجة.'],
                'image_url' => '/menuItems_seeders/sandwiches/panini_thon.jpg',
                'base_price' => 35.00,
            ],
            [
                // ================== Sandwich Dinde Fumé ==================
                'menu_category_id' => 5,
                'name' => ['fr' => 'Sandwich Dinde Fumé', 'en' => 'Smoked Turkey Sandwich', 'ar' => 'ساندويتش الديك الرومي المدخن'],
                'description' => ['fr' => 'Fines tranches de dinde fumée, fromage, beurre et cornichons dans une baguette fraîche.', 'en' => 'Thin slices of smoked turkey, cheese, butter, and pickles in a fresh baguette.', 'ar' => 'شرائح رقيقة من الديك الرومي المدخن، جبن، زبدة، ومخلل في خبز باجيت طازج.'],
                'image_url' => '/menuItems_seeders/sandwiches/dindefume.jpg',
                'base_price' => 30.00,
            ],
            [
                // ================== Sandwich Mixte ==================
                'menu_category_id' => 5,
                'name' => ['fr' => 'Sandwich Mixte', 'en' => 'Mixed Sandwich', 'ar' => 'ساندويتش مختلط'],
                'description' => ['fr' => 'Pour les grosses faims : Kefta, Merguez, salade, frites, le tout dans une baguette croustillante.', 'en' => 'For big appetites: Kefta, Merguez, salad, fries, all in a crispy baguette.', 'ar' => 'للشهية الكبيرة: كفتة، مرقاز، سلطة، بطاطس مقلية، الكل في خبز باجيت مقرمش.'],
                'image_url' => '/menuItems_seeders/sandwiches/mixte.jpg',
                'base_price' => 45.00,
            ],
            [
                // ================== Bocadillo Classique ==================
                'menu_category_id' => 5,
                'name' => ['fr' => 'Bocadillo Classique', 'en' => 'Classic Bocadillo', 'ar' => 'بوكاديوس كلاسيك'],
                'description' => ['fr' => 'Le goût authentique du Maroc : thon, œuf dur, pommes de terre, olives et salade.', 'en' => 'The authentic taste of Morocco: tuna, hard-boiled egg, potatoes, olives, and salad.', 'ar' => 'الطعم الأصيل للمغرب: تونة، بيض مسلوق، بطاطس، زيتون، وسلطة.'],
                'image_url' => '/menuItems_seeders/sandwiches/bocadillo.jpg',
                'base_price' => 25.00,
            ],

            // =========================================================================
            // CATEGORY 6: ASSIETTES (PLATES)
            // =========================================================================
            [
                // ================== Assiette Shawarma ==================
                'menu_category_id' => 6,
                'name' => ['fr' => 'Assiette Shawarma', 'en' => 'Shawarma Plate', 'ar' => 'طبق شاورما'],
                'description' => ['fr' => 'Une généreuse portion de notre viande shawarma, servie avec frites, salade fraîche, riz et pain.', 'en' => 'A generous portion of our shawarma meat, served with fries, fresh salad, rice, and bread.', 'ar' => 'كمية سخية من لحم الشاورما لدينا، تقدم مع بطاطس مقلية، سلطة طازجة، أرز وخبز.'],
                'image_url' => '/menuItems_seeders/assiettes/shawarma.jpg',
                'base_price' => 65.00,
            ],
            [
                // ================== Assiette Kefta ==================
                'menu_category_id' => 6,
                'name' => ['fr' => 'Assiette Kefta', 'en' => 'Kefta Plate', 'ar' => 'طبق كفتة'],
                'description' => ['fr' => 'De savoureuses brochettes de kefta grillées à la perfection, accompagnées de frites, salade et riz.', 'en' => 'Flavorful kefta skewers grilled to perfection, accompanied by fries, salad, and rice.', 'ar' => 'أسياخ كفتة لذيذة مشوية بإتقان، تقدم مع بطاطس مقلية، سلطة وأرز.'],
                'image_url' => '/menuItems_seeders/assiettes/kefta.jpg',
                'base_price' => 70.00,
            ],
            [
                // ================== Assiette Poulet Grillé ==================
                'menu_category_id' => 6,
                'name' => ['fr' => 'Assiette Poulet Grillé', 'en' => 'Grilled Chicken Plate', 'ar' => 'طبق دجاج مشوي'],
                'description' => ['fr' => 'Un blanc de poulet tendre et juteux, mariné et grillé, servi avec frites et salade.', 'en' => 'A tender and juicy chicken breast, marinated and grilled, served with fries and salad.', 'ar' => 'صدر دجاج طري وشهي، متبل ومشوي، يقدم مع بطاطس مقلية وسلطة.'],
                'image_url' => '/menuItems_seeders/assiettes/poulet.jpg',
                'base_price' => 65.00,
            ],
            [
                // ================== Assiette Mixte ==================
                'menu_category_id' => 6,
                'name' => ['fr' => 'Assiette Mixte (Grillades)', 'en' => 'Mixed Grill Plate', 'ar' => 'طبق مشويات مشكلة'],
                'description' => ['fr' => 'Le plat idéal pour les indécis : un assortiment de nos meilleures grillades (shawarma, kefta, merguez).', 'en' => 'The ideal dish for the undecided: an assortment of our best grills (shawarma, kefta, merguez).', 'ar' => 'الطبق المثالي للمترددين: تشكيلة من أفضل مشوياتنا (شاورما، كفتة، مرقاز).'],
                'image_url' => '/menuItems_seeders/assiettes/mixte.jpg',
                'base_price' => 80.00,
            ],

            // =========================================================================
            // CATEGORY 7: SALADES
            // =========================================================================
            [
                // ================== Salade Marocaine ==================
                'menu_category_id' => 7,
                'name' => ['fr' => 'Salade Marocaine', 'en' => 'Moroccan Salad', 'ar' => 'سلطة مغربية'],
                'description' => ['fr' => 'Une salade fraîche et simple avec des tomates juteuses, concombres croquants et oignons, assaisonnée à la marocaine.', 'en' => 'A fresh and simple salad with juicy tomatoes, crunchy cucumbers, and onions, with a Moroccan dressing.', 'ar' => 'سلطة طازجة وبسيطة مكونة من طماطم طرية، خيار مقرمش، وبصل، متبلة على الطريقة المغربية.'],
                'image_url' => '/menuItems_seeders/salads/marocaine.jpg',
                'base_price' => 25.00,
            ],
            [
                // ================== Salade Niçoise ==================
                'menu_category_id' => 7,
                'name' => ['fr' => 'Salade Niçoise', 'en' => 'Niçoise Salad', 'ar' => 'سلطة نيسواز'],
                'description' => ['fr' => 'Un classique de la Méditerranée : laitue, thon, œuf dur, tomates, olives et haricots verts.', 'en' => 'A Mediterranean classic: lettuce, tuna, hard-boiled egg, tomatoes, olives, and green beans.', 'ar' => 'كلاسيكية من البحر الأبيض المتوسط: خس، تونة، بيض مسلوق، طماطم، زيتون، وفاصوليا خضراء.'],
                'image_url' => '/menuItems_seeders/salads/nicoise.jpg',
                'base_price' => 55.00,
            ],
            [
                // ================== Salade César ==================
                'menu_category_id' => 7,
                'name' => ['fr' => 'Salade César', 'en' => 'Caesar Salad', 'ar' => 'سلطة سيزر'],
                'description' => ['fr' => 'La fameuse salade avec laitue romaine, poulet grillé, croûtons croustillants et copeaux de parmesan.', 'en' => 'The famous salad with romaine lettuce, grilled chicken, crispy croutons, and parmesan shavings.', 'ar' => 'السلطة الشهيرة المكونة من خس روماني، دجاج مشوي، خبز محمص مقرمش، ورقائق البارميزان.'],
                'image_url' => '/menuItems_seeders/salads/cesar.jpg',
                'base_price' => 50.00,
            ],
            [
                // ================== Salade du Chef ==================
                'menu_category_id' => 7,
                'name' => ['fr' => 'Salade du Chef', 'en' => 'Chef\'s Salad', 'ar' => 'سلطة الشيف'],
                'description' => ['fr' => 'La création spéciale de notre chef : laitue, maïs, thon, fromage Edam, avocat et carottes.', 'en' => 'Our chef\'s special creation: lettuce, corn, tuna, Edam cheese, avocado, and carrots.', 'ar' => 'إبداع الشيف الخاص: خس، ذرة، تونة، جبن إيدام، أفوكادو، وجزر.'],
                'image_url' => '/menuItems_seeders/salads/chef.jpg',
                'base_price' => 60.00,
            ],

            // =========================================================================
            // CATEGORY 8: ACCOMPAGNEMENTS (SIDES)
            // =========================================================================
            [
                // ================== Frites ==================
                'menu_category_id' => 8,
                'name' => ['fr' => 'Frites', 'en' => 'French Fries', 'ar' => 'بطاطس مقلية'],
                'description' => ['fr' => 'Une portion généreuse de frites dorées, croustillantes à l\'extérieur et moelleuses à l\'intérieur.', 'en' => 'A generous portion of golden fries, crispy on the outside and soft on the inside.', 'ar' => 'كمية سخية من البطاطس المقلية الذهبية، مقرمشة من الخارج وطرية من الداخل.'],
                'image_url' => '/menuItems_seeders/sides/frites.jpg',
                'base_price' => 15.00,
            ],
            [
                // ================== Ailes de Poulet ==================
                'menu_category_id' => 8,
                'name' => ['fr' => 'Ailes de Poulet (6 pièces)', 'en' => 'Chicken Wings (6 pieces)', 'ar' => 'أجنحة دجاج (6 قطع)'],
                'description' => ['fr' => 'Six ailes de poulet marinées dans nos épices secrètes, puis frites à la perfection.', 'en' => 'Six chicken wings marinated in our secret spices, then fried to perfection.', 'ar' => 'ست قطع من أجنحة الدجاج المتبلة ببهاراتنا السرية، ثم مقلية بإتقان.'],
                'image_url' => '/menuItems_seeders/sides/wings.jpg',
                'base_price' => 35.00,
            ],
            [
                // ================== Riz ==================
                'menu_category_id' => 8,
                'name' => ['fr' => 'Portion de Riz', 'en' => 'Portion of Rice', 'ar' => 'طبق أرز'],
                'description' => ['fr' => 'Un riz parfumé et savoureux, parfait pour accompagner nos grillades.', 'en' => 'A fragrant and flavorful rice, perfect to accompany our grilled dishes.', 'ar' => 'أرز عطري ولذيذ، مثالي لمرافقة أطباق المشويات لدينا.'],
                'image_url' => '/menuItems_seeders/sides/rice.jpg',
                'base_price' => 12.00,
            ],

            // =========================================================================
            // CATEGORY 9: DESSERTS
            // =========================================================================
            [
                // ================== Mousse au Chocolat ==================
                'menu_category_id' => 9,
                'name' => ['fr' => 'Mousse au Chocolat', 'en' => 'Chocolate Mousse', 'ar' => 'موس الشوكولاتة'],
                'description' => ['fr' => 'Une mousse au chocolat riche, intense et aérienne, préparée selon notre recette maison.', 'en' => 'A rich, intense, and airy chocolate mousse, prepared according to our homemade recipe.', 'ar' => 'موس شوكولاتة غني، مركز، وخفيف، محضر وفقًا لوصفتنا المنزلية.'],
                'image_url' => '/menuItems_seeders/desserts/mousse.jpg',
                'base_price' => 25.00,
            ],
            [
                // ================== Tiramisu ==================
                'menu_category_id' => 9,
                'name' => ['fr' => 'Tiramisu', 'en' => 'Tiramisu', 'ar' => 'تيراميسو'],
                'description' => ['fr' => 'Le grand classique italien : une crème mascarpone onctueuse et des biscuits imbibés de café.', 'en' => 'The great Italian classic: a creamy mascarpone cream and coffee-soaked ladyfingers.', 'ar' => 'الكلاسيكية الإيطالية العظيمة: كريمة مسكربون غنية وبسكويت مغموس في القهوة.'],
                'image_url' => '/menuItems_seeders/desserts/tiramisu.jpg',
                'base_price' => 30.00,
            ],
            [
                // ================== Salade de Fruits ==================
                'menu_category_id' => 9,
                'name' => ['fr' => 'Salade de Fruits Frais', 'en' => 'Fresh Fruit Salad', 'ar' => 'سلطة فواكه طازجة'],
                'description' => ['fr' => 'Un mélange rafraîchissant de fruits de saison, pour une fin de repas légère et saine.', 'en' => 'A refreshing mix of seasonal fruits, for a light and healthy end to your meal.', 'ar' => 'مزيج منعش من فواكه الموسم، لنهاية وجبة خفيفة وصحية.'],
                'image_url' => '/menuItems_seeders/desserts/fruitsalad.jpg',
                'base_price' => 20.00,
            ],

            // =========================================================================
            // CATEGORY 10: BOISSONS (DRINKS)
            // =========================================================================
            [
                // ================== Coca-Cola ==================
                'menu_category_id' => 10,
                'name' => ['fr' => 'Coca-Cola', 'en' => 'Coca-Cola', 'ar' => 'كوكا كولا'],
                'description' => ['fr' => 'La boisson gazeuse la plus populaire au monde. Canette 33cl.', 'en' => 'The world\'s most popular soft drink. 33cl can.', 'ar' => 'المشروب الغازي الأكثر شهرة في العالم. علبة 33 سنتيلتر.'],
                'image_url' => '/menuItems_seeders/drinks/cocacola.jpg',
                'base_price' => 12.00,
            ],
            [
                // ================== Fanta Orange ==================
                'menu_category_id' => 10,
                'name' => ['fr' => 'Fanta Orange', 'en' => 'Fanta Orange', 'ar' => 'فانتا برتقال'],
                'description' => ['fr' => 'Le goût pétillant de l\'orange. Canette 33cl.', 'en' => 'The sparkling taste of orange. 33cl can.', 'ar' => 'مذاق البرتقال الفوار. علبة 33 سنتيلتر.'],
                'image_url' => '/menuItems_seeders/drinks/fanta.jpg',
                'base_price' => 12.00,
            ],
            [
                // ================== Sprite ==================
                'menu_category_id' => 10,
                'name' => ['fr' => 'Sprite', 'en' => 'Sprite', 'ar' => 'سبرايت'],
                'description' => ['fr' => 'Le rafraîchissement ultime au citron. Canette 33cl.', 'en' => 'The ultimate lemon-lime refreshment. 33cl can.', 'ar' => 'الانتعاش المطلق بالليمون. علبة 33 سنتيلتر.'],
                'image_url' => '/menuItems_seeders/drinks/sprite.jpg',
                'base_price' => 12.00,
            ],
            [
                // ================== Eau Plate (Sidi Ali) ==================
                'menu_category_id' => 10,
                'name' => ['fr' => 'Eau Plate (Sidi Ali)', 'en' => 'Still Water (Sidi Ali)', 'ar' => 'ماء معدني (سيدي علي)'],
                'description' => ['fr' => 'Eau minérale naturelle. Bouteille 50cl.', 'en' => 'Natural mineral water. 50cl bottle.', 'ar' => 'ماء معدني طبيعي. قنينة 50 سنتيلتر.'],
                'image_url' => '/menuItems_seeders/drinks/sidiali.jpg',
                'base_price' => 10.00,
            ],
            [
                // ================== Eau Gazeuse (Oulmès) ==================
                'menu_category_id' => 10,
                'name' => ['fr' => 'Eau Gazeuse (Oulmès)', 'en' => 'Sparkling Water (Oulmès)', 'ar' => 'ماء غازي (أولماس)'],
                'description' => ['fr' => 'L\'eau naturellement pétillante des montagnes de l\'Atlas. Bouteille 50cl.', 'en' => 'Naturally sparkling water from the Atlas mountains. 50cl bottle.', 'ar' => 'ماء فوار طبيعي من جبال الأطلس. قنينة 50 سنتيلتر.'],
                'image_url' => '/menuItems_seeders/drinks/oulmes.jpg',
                'base_price' => 12.00,
            ],
            [
                // ================== Jus d'Orange Frais ==================
                'menu_category_id' => 10,
                'name' => ['fr' => 'Jus d\'Orange Frais', 'en' => 'Fresh Orange Juice', 'ar' => 'عصير برتقال طازج'],
                'description' => ['fr' => 'Pressé à la minute pour un maximum de vitamines et de fraîcheur.', 'en' => 'Freshly squeezed to order for maximum vitamins and freshness.', 'ar' => 'معصور في الحين للحصول على أقصى قدر من الفيتامينات والانتعاش.'],
                'image_url' => '/menuItems_seeders/drinks/orangejuice.jpg',
                'base_price' => 20.00,
            ],
            [
                // ================== Jus d'Avocat ==================
                'menu_category_id' => 10,
                'name' => ['fr' => 'Jus d\'Avocat', 'en' => 'Avocado Juice', 'ar' => 'عصير الأفوكادو'],
                'description' => ['fr' => 'Un jus crémeux, nutritif et délicieusement marocain.', 'en' => 'A creamy, nutritious, and deliciously Moroccan juice.', 'ar' => 'عصير كريمي ومغذي ومغربي بامتياز.'],
                'image_url' => '/menuItems_seeders/drinks/avocadojuice.jpg',
                'base_price' => 25.00,
            ],
            [
                // ================== Panaché ==================
                'menu_category_id' => 10,
                'name' => ['fr' => 'Panaché', 'en' => 'Mixed Fruit Smoothie', 'ar' => 'بانا شيه'],
                'description' => ['fr' => 'Un délicieux cocktail de fruits de saison mixés, plein d\'énergie.', 'en' => 'A delicious cocktail of blended seasonal fruits, full of energy.', 'ar' => 'كوكتيل لذيذ من فواكه الموسم المخفوقة، مليء بالطاقة.'],
                'image_url' => '/menuItems_seeders/drinks/panache.jpg',
                'base_price' => 25.00,
            ],
            [
                // ================== Thé à la Menthe ==================
                'menu_category_id' => 10,
                'name' => ['fr' => 'Thé à la Menthe Marocain', 'en' => 'Moroccan Mint Tea', 'ar' => 'شاي بالنعناع المغربي'],
                'description' => ['fr' => 'Le symbole de l\'hospitalité marocaine, servi chaud et sucré.', 'en' => 'The symbol of Moroccan hospitality, served hot and sweet.', 'ar' => 'رمز الضيافة المغربية، يقدم ساخناً وحلواً.'],
                'image_url' => '/menuItems_seeders/drinks/minttea.jpg',
                'base_price' => 10.00,
            ],
            [
                // ================== Café Noir ==================
                'menu_category_id' => 10,
                'name' => ['fr' => 'Café Noir (Espresso)', 'en' => 'Black Coffee (Espresso)', 'ar' => 'قهوة سوداء (إسبريسو)'],
                'description' => ['fr' => 'Un espresso intense et corsé pour bien démarrer ou finir le repas.', 'en' => 'An intense and full-bodied espresso to start or finish your meal.', 'ar' => 'إسبريسو مركز وغني لتبدأ أو تنهي وجبتك.'],
                'image_url' => '/menuItems_seeders/drinks/espresso.jpg',
                'base_price' => 10.00,
            ],
        ];

        // Loop through the data and create the menu items
        foreach ($menuItems as $itemData) {
            // Set default values that are common to all items
            $defaults = [
                'restaurant_id' => 1,
                'is_available' => true,
            ];

            // Merge defaults with specific item data, allowing item data to override
            $finalData = array_merge($defaults, $itemData);

            MenuItem::create($finalData);
        }
    }
}
