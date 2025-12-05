<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\GlobalSection;
use App\Models\User;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::first(); // Assign first user as author

        // List of pages
        $pages = [
            'Home',
            'About Us',
            'Contact Us',
            'Privacy Policy',
            'Terms & Conditions',
            'Sitemap',
            'Cart',
            'Checkout',
            'Login',
            'Register',
            'Shop',
            'Category'
        ];

        // Template map (from your config or define inline)
        $templateMap = [
            'home' => 'home',
            'about-us' => 'about',
            'contact-us' => 'contact',
            'privacy-policy' => 'default',
            'terms-conditions' => 'default',
            'sitemap' => 'default',
            'cart' => 'cart',
            'checkout' => 'checkout',
            'login' => 'auth',
            'register' => 'auth',
            'shop' => 'shop',
            'category' => 'category',
        ];

        foreach ($pages as $title) {
            $slug = Str::slug($title);
            $template = $templateMap[$slug] ?? 'default';

            $page = Page::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $title,
                    'short_description' => 'Coming soon',
                    'description' => 'Coming soon',
                    'template' => $template,
                    'status' => true,
                    'author_id' => $author?->id,
                ]
            );

            $this->command->info("✅ Page created/updated: {$page->title} with template '{$template}'");
        }

        // Example Global Sections (optional)
        $globalsections = [
            [
                'title' => 'Money Magnet Pyramid',
                'slug' => Str::slug('Money Magnet Pyramid'),
                'short_description' => 'Coming soon',
                'description' => 'Coming soon',
                'template' => 'banner',
                'page_id' => Page::where('slug', 'home')->first()?->id,
                'status' => 1,
            ],
            [
                'title' => 'Rose Quartz Palm Stone',
                'slug' => Str::slug('Rose Quartz Palm Stone'),
                'short_description' => 'Coming soon',
                'description' => 'Coming soon',
                'template' => 'banner',
                'page_id' => Page::where('slug', 'home')->first()?->id,
                'status' => 1,
            ],
        ];

        foreach ($globalsections as $section) {
            $record = GlobalSection::updateOrCreate(
                ['slug' => $section['slug']],
                $section
            );

            $this->command->info("🔄 Global Section inserted/updated: {$record->title}");
        }
    }
}
