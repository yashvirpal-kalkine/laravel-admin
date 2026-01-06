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
            ['title' => 'Love', 'image' => null],
            ['title' => 'Money', 'image' => null],
            ['title' => 'Career', 'image' => null],
            ['title' => 'Health', 'image' => null],
            ['title' => 'Marriage', 'image' => null],
            ['title' => 'Gifts', 'image' => null],
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
            ['title' => 'Aries', 'image' => null],
            ['title' => 'Taurus', 'image' => null],
            ['title' => 'Gemini', 'image' => null],
            ['title' => 'Cancer', 'image' => null],
            ['title' => 'Leo', 'image' => null],
            ['title' => 'Virgo', 'image' => null],
            ['title' => 'Libra', 'image' => null],
            ['title' => 'Scorpio', 'image' => null],
            ['title' => 'Sagittarius', 'image' => null],
            ['title' => 'Capricorn', 'image' => null],
            ['title' => 'Aquarius', 'image' => null],
            ['title' => 'Pisces', 'image' => null],
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

        for ($i = 1; $i <= 11; $i++) {
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
            if ($i == 2) {
                $title = "Membership Plans";
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
