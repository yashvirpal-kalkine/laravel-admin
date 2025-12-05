<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use App\Models\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = User::first();

        // // 1️⃣ Create Product Categories
        // $categories = [
        //     ['title' => 'Electronics', 'slug' => 'electronics', 'status' => true],
        //     ['title' => 'Clothing', 'slug' => 'clothing', 'status' => true],
        //     ['title' => 'Home & Kitchen', 'slug' => 'home-kitchen', 'status' => true],
        // ];

        // foreach ($categories as $cat) {
        //     ProductCategory::firstOrCreate(
        //         ['slug' => $cat['slug']],
        //         array_merge($cat, ['author_id' => $author?->id])
        //     );
        // }


        // -----------------------------
        // PARENT CATEGORY: Shop By Concern
        // -----------------------------
        $concernParent = ProductCategory::create([
            'title' => 'Shop By Concern',
            'slug' => Str::slug('Shop By Concern'),
            'parent_id' => null,
            'image' => null,
            'status' => 1,
        ]);

        $concernItems = [
            ['title' => 'Love', 'image' => 'assets/images/s1.jpg'],
            ['title' => 'Money', 'image' => 'assets/images/s2.jpg'],
            ['title' => 'Career', 'image' => 'assets/images/s3.jpg'],
            ['title' => 'Health', 'image' => 'assets/images/s4.jpg'],
            ['title' => 'Marriage', 'image' => 'assets/images/s5.jpg'],
            ['title' => 'Gifts', 'image' => 'assets/images/s6.jpg'],
        ];

        foreach ($concernItems as $item) {
            ProductCategory::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'parent_id' => $concernParent->id,
                'image' => $item['image'],
                'image_alt' => $item['title'],
                'status' => 1,
            ]);
        }

        // -----------------------------
        // PARENT CATEGORY: Shop By Zodiac
        // -----------------------------
        $zodiacParent = ProductCategory::create([
            'title' => 'Shop By Zodiac',
            'slug' => Str::slug('Shop By Zodiac'),
            'parent_id' => null,
            'image' => null,
            'status' => 1,
        ]);

        $zodiacItems = [
            ['title' => 'Aries', 'image' => 'assets/images/m1.png'],
            ['title' => 'Taurus', 'image' => 'assets/images/m2.png'],
            ['title' => 'Gemini', 'image' => 'assets/images/m3.png'],
            ['title' => 'Cancer', 'image' => 'assets/images/m4.png'],
            ['title' => 'Leo', 'image' => 'assets/images/m5.png'],
            ['title' => 'Virgo', 'image' => 'assets/images/m6.png'],
            ['title' => 'Libra', 'image' => 'assets/images/m7.png'],
            ['title' => 'Scorpio', 'image' => 'assets/images/m8.png'],
            ['title' => 'Sagittarius', 'image' => 'assets/images/m9.png'],
            ['title' => 'Capricorn', 'image' => 'assets/images/m10.png'],
            ['title' => 'Aquarius', 'image' => 'assets/images/m11.png'],
            ['title' => 'Pisces', 'image' => 'assets/images/m12.png'],
        ];

        foreach ($zodiacItems as $item) {
            ProductCategory::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'parent_id' => $zodiacParent->id,
                'image' => $item['image'],
                'image_alt' => $item['title'],
                'status' => 1,
            ]);
        }


        // -----------------------------
        // OTHER DIRECT CATEGORIES
        // -----------------------------
        $otherItems = [
            ['title' => 'Customised Bracelets', 'image' => null],
            ['title' => 'Corporate Gifts', 'image' => null],
            ['title' => 'Puja Needs', 'image' => null],
            ['title' => 'Bracelets', 'image' => null],
            ['title' => 'Rudraksha', 'image' => null],
            ['title' => 'Pyrite', 'image' => null],
            ['title' => 'Stone', 'image' => null],
            ['title' => 'Shankh', 'image' => null],
            ['title' => 'Pendants', 'image' => null],
        ];

        foreach ($otherItems as $item) {
            ProductCategory::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'parent_id' => null,
                'image' => $item['image'],
                'status' => 1,
            ]);
        }

        $this->command->info('✅ Product categories created');

        // 2️⃣ Create Product Tags
        $tags = [
            ['title' => 'New Arrival', 'slug' => 'new-arrival', 'status' => true],
            ['title' => 'Sale', 'slug' => 'sale', 'status' => true],
            ['title' => 'Popular', 'slug' => 'popular', 'status' => true],
        ];

        foreach ($tags as $tag) {
            ProductTag::firstOrCreate(
                ['slug' => $tag['slug']],
                array_merge($tag, ['author_id' => $author?->id])
            );
        }
        $this->command->info('✅ Product tags created');

        // 3️⃣ Create Products
        $categoriesAll = ProductCategory::all();
        $tagsAll = ProductTag::all();

        for ($i = 1; $i <= 10; $i++) {
            if ($i == 1) {
                $title = "Customised Bracelets";
                $product = Product::firstOrCreate(
                    ['slug' => Str::slug($title)],
                    [
                        'title' => $title,
                        'short_description' => "Short description for {$title}",
                        'description' => "Full description for {$title}. Lorem ipsum dolor sit amet.",
                        'regular_price' => rand(50, 500),
                        'sale_price' => rand(30, 100),
                        'stock' => rand(10, 100),
                        'is_featured' => rand(0, 1),
                        'status' => true,
                        'author_id' => $author?->id,
                    ]
                );

                // 4️⃣ Attach random categories
                $product->categories()->sync(
                    $categoriesAll->random(rand(1, 2))->pluck('id')->toArray()
                );

                // 5️⃣ Attach random tags
                $product->tags()->sync(
                    $tagsAll->random(rand(1, 2))->pluck('id')->toArray()
                );
            }
            $title = "Sample Product {$i}";
            $product = Product::firstOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'short_description' => "Short description for {$title}",
                    'description' => "Full description for {$title}. Lorem ipsum dolor sit amet.",
                    'regular_price' => rand(50, 500),
                    'sale_price' => rand(30, 100),
                    'stock' => rand(10, 100),
                    'is_featured' => rand(0, 1),
                    'status' => true,
                    'author_id' => $author?->id,
                ]
            );

            // 4️⃣ Attach random categories
            $product->categories()->sync(
                $categoriesAll->random(rand(1, 2))->pluck('id')->toArray()
            );

            // 5️⃣ Attach random tags
            $product->tags()->sync(
                $tagsAll->random(rand(1, 2))->pluck('id')->toArray()
            );
        }

        $this->command->info('✅ 10 sample products created with categories and tags');
    }
}
