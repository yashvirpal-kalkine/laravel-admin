<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
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

    }
}
