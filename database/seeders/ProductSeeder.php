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

        // 1️⃣ Create Product Categories
        $categories = [
            ['title' => 'Electronics', 'slug' => 'electronics', 'status' => 'published'],
            ['title' => 'Clothing', 'slug' => 'clothing', 'status' => 'published'],
            ['title' => 'Home & Kitchen', 'slug' => 'home-kitchen', 'status' => 'published'],
        ];

        foreach ($categories as $cat) {
            ProductCategory::firstOrCreate(
                ['slug' => $cat['slug']],
                array_merge($cat, ['author_id' => $author?->id])
            );
        }
        $this->command->info('✅ Product categories created');

        // 2️⃣ Create Product Tags
        $tags = [
            ['title' => 'New Arrival', 'slug' => 'new-arrival', 'status' => 'published'],
            ['title' => 'Sale', 'slug' => 'sale', 'status' => 'published'],
            ['title' => 'Popular', 'slug' => 'popular', 'status' => 'published'],
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
            $title = "Sample Product {$i}";
            $product = Product::firstOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'short_description' => "Short description for {$title}",
                    'description' => "Full description for {$title}. Lorem ipsum dolor sit amet.",
                    'price' => rand(50, 500),
                    'discount_price' => rand(30, 100),
                    'stock' => rand(10, 100),
                    'is_featured' => rand(0, 1),
                    'status' => 'published',
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
