<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'site_name' => 'My Awesome Site',
            'site_email' => 'info@localhost.com',
            'currency' => 'INR',
            'currency_symbol' => '₹',
            'phone' => '+1 234 567 890',
            'address' => '123 Main Street, City, Country',
            'footer_text' => '© 2025 My Awesome Site. All rights reserved.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $this->command->info('✅ Default settings seeded successfully.');
    }
}
