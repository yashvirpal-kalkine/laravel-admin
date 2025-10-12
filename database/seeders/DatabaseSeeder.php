<?php

namespace Database\Seeders;

use App\Models\User;
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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@localhost.com',
            'password' => Hash::make('password'),
        ]);
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@localhost.com',
            'password' => Hash::make('password'),
        ]);
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@localhost.com',
            'password' => Hash::make('password'),
        ]);
    }
}
