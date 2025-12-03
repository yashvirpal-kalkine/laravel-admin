<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\GlobalSection;
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
        $author = User::first(); // Assign first user as author

        $pages = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'short_description' => 'Welcome to our website.',
                'description' => 'This is the Home page. Explore our latest products and updates.',
                'status' => true,
            ],
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'short_description' => 'Learn more about our company.',
                'description' => 'This is the About Us page. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'status' => true,
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'short_description' => 'Get in touch with us.',
                'description' => 'This is the Contact Us page. You can reach us via email or phone.',
                'status' => true,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'short_description' => 'Our privacy practices.',
                'description' => 'This page explains our privacy policy in detail.',
                'status' => true,
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-conditions',
                'short_description' => 'Our terms and conditions.',
                'description' => 'This page outlines our terms and conditions for using our services.',
                'status' => true,
            ],
            [
                'title' => 'Sitemap',
                'slug' => 'sitemap',
                'short_description' => 'Website structure overview.',
                'description' => 'This page provides a sitemap for easier navigation across the site.',
                'status' => true,
            ],
        ];

        foreach ($pages as $page) {
            $record = Page::firstOrCreate(
                ['slug' => $page['slug']],
                array_merge($page, ['author_id' => $author?->id])
            );

            $this->command->info("✅ Page created/exists: {$record->title}");
        }

        $globalsections = [

            [
                'title' => 'Money Magnet Pyramid',
                'slug' => Str::slug('Money Magnet Pyramid'),
                'short_description' => 'Activate Money Flow Energy In Your Life',
                'description' => '<p>Activate Money Flow Energy In Your Life</p>',
                'image' => null,
                'image_alt' => 'Money Magnet Pyramid Image',
                'button_text' => 'Shop Now',
                'button_link' => '/shop',
                'template' => 'banner',
                'page_id' => 1,
                'custom_field' => null,
                'status' => 1,
            ],

            [
                'title' => 'Rose Quartz Palm Stone',
                'slug' => Str::slug('Rose Quartz Palm Stone'),
                'short_description' => 'Attract love, peace & emotional healing naturally.',
                'description' => '<p>Attract love, peace & emotional healing naturally.</p>',
                'image' => null,
                'image_alt' => 'Rose Quartz Palm Stone Image',
                'button_text' => 'Shop Now',
                'button_link' => '/shop',
                'template' => 'banner',
                'page_id' => 1,
                'custom_field' => null,
                'status' => 1,
            ],

        ];

        foreach ($globalsections as $globalsection) {
            $record = GlobalSection::updateOrCreate(
                ['slug' => $globalsection['slug']],
                $globalsection
            );

            $this->command->info("🔄 Global Section inserted/updated: {$record->title}");
        }


    }
}
