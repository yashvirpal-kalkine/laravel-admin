<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GlobalSection;
use App\Models\Slider;
use Illuminate\Support\Str;
use App\Models\Admin; 
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            PageSeeder::class,
            BlogSeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
            CouponSeeder::class,
            SettingSeeder::class,
        ]);

        // Example Global Sections (optional)
        $globalsections = [
            [
                'title' => 'Money Magnet Pyramid',
                'slug' => Str::slug('Money Magnet Pyramid'),
                'short_description' => 'Coming soon',
                'description' => 'Coming soon',
                'template' => '1',
                'page_id' =>1,
                'status' => 1,
            ],
            [
                'title' => 'Rose Quartz Palm Stone',
                'slug' => Str::slug('Rose Quartz Palm Stone'),
                'short_description' => 'Coming soon',
                'description' => 'Coming soon',
                'template' => '1',
                'page_id' =>1,
                'status' => 1,
            ],
            [
                'title' => 'Guarantee of Purity',
                'slug' => Str::slug('Guarantee of Purity'),
                'template' => '0',
                'page_id' =>1,
                'status' => 1,
            ],
            [
                'title' => '100% Natural & Certified',
                'slug' => Str::slug('100% Natural & Certified'),
                'template' => '0',
                'page_id' =>1,
                'status' => 1,
            ],
            [
                'title' => 'Ethically Sourced',
                'slug' => Str::slug('Ethically Sourced'),
                'template' => '0',
                'page_id' =>1,
                'status' => 1,
            ],
            [
                'title' => 'Free Shipping',
                'slug' => Str::slug('Free Shipping'),
                'template' => '0',
                'page_id' =>1,
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
        // Slider
        $sliders = [
            [
                'title' => 'Slider 1',
                'short_description' => 'Coming soon',
                'description' => 'Coming soon',
                'status' => 1,
            ],
            [
                'title' => 'Slider 2',
                'short_description' => 'Coming soon',
                'description' => 'Coming soon',
                'status' => 1,
            ],
        ];

        foreach ($sliders as $slider) {

            $record = Slider::updateOrCreate(
                ['title' => $slider['title']], // match by unique title
                $slider                      // update all fields
            );

            $this->command->info("🔄 Slider inserted/updated: {$record->title}");
        }

    }
}
