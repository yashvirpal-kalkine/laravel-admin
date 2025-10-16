<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = User::first(); // Assign first user as author, adjust as needed

        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'short_description' => 'Learn more about our company.',
                'description' => 'This is the About Us page. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'short_description' => 'Get in touch with us.',
                'description' => 'This is the Contact Us page. You can reach us via email or phone.',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(3),
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'short_description' => 'Our privacy practices.',
                'description' => 'This page explains our privacy policy in detail.',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(10),
            ],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(
                ['slug' => $page['slug']],
                array_merge($page, ['author_id' => $author?->id])
            );
            $this->command->info("✅ Page created: {$page['title']}");
        }

        // Optional: create 5 random pages using factory if needed
        if (class_exists(\Database\Factories\PageFactory::class)) {
            Page::factory()->count(5)->create();
            $this->command->info("✅ 5 random pages created using factory");
        }
    }
}
