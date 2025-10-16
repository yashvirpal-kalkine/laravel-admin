<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\BlogPost;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1️⃣ Create Blog Categories
        $categories = [
            ['title' => 'Tech', 'slug' => 'tech', 'status' => 'published'],
            ['title' => 'Lifestyle', 'slug' => 'lifestyle', 'status' => 'published'],
            ['title' => 'Business', 'slug' => 'business', 'status' => 'published'],
        ];

        foreach ($categories as $cat) {
            BlogCategory::firstOrCreate(
                ['slug' => $cat['slug']],
                array_merge($cat, ['author_id' => Admin::first()?->id ?? null])
            );
        }

        $this->command->info('✅ Blog categories created');

        // 2️⃣ Create Blog Tags
        $tags = [
            ['title' => 'Tips', 'slug' => 'tips', 'status' => 'published'],
            ['title' => 'Tutorial', 'slug' => 'tutorial', 'status' => 'published'],
            ['title' => 'News', 'slug' => 'news', 'status' => 'published'],
        ];

        foreach ($tags as $tag) {
            BlogTag::firstOrCreate(
                ['slug' => $tag['slug']],
                array_merge($tag, ['author_id' => User::first()?->id ?? null])
            );
        }

        $this->command->info('✅ Blog tags created');

        // 3️⃣ Create Blog Posts
        $categoriesAll = BlogCategory::all();
        $tagsAll = BlogTag::all();
        $author = User::first() ?? Admin::first();

        for ($i = 1; $i <= 10; $i++) {
            $title = "Sample Blog Post {$i}";
            $post = BlogPost::firstOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'short_description' => "This is a short description for post {$i}.",
                    'description' => "This is a full description for post {$i}. Lorem ipsum dolor sit amet.",
                    'status' => 'published',
                    'author_id' => $author?->id,
                    'published_at' => Carbon::now()->subDays(rand(0, 30)),
                ]
            );

            // 4️⃣ Attach categories and tags
            $post->categories()->sync(
                $categoriesAll->random(rand(1, 2))->pluck('id')->toArray()
            );

            $post->tags()->sync(
                $tagsAll->random(rand(1, 3))->pluck('id')->toArray()
            );
        }

        $this->command->info('✅ 10 sample blog posts created with categories and tags');
    }
}
