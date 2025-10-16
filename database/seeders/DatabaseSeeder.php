<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin; // Make sure this import matches your model's namespace
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
        ]);
    }
}
