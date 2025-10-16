<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [
            [
                'title' => 'New Year Discount',
                'code' => 'NEWYEAR2026',
                'type' => 'percentage', // 'percentage' or 'fixed'
                'value' => 15,
                'status' => 'active',
                'valid_from' => Carbon::now(),
                'valid_until' => Carbon::now()->addMonth(),
            ],
            [
                'title' => 'Holiday Sale',
                'code' => 'HOLIDAY50',
                'type' => 'fixed',
                'value' => 50,
                'status' => 'active',
                'valid_from' => Carbon::now(),
                'valid_until' => Carbon::now()->addWeeks(2),
            ],
            [
                'title' => 'Inactive Test Coupon',
                'code' => 'TEST10',
                'type' => 'percentage',
                'value' => 10,
                'status' => 'inactive',
                'valid_from' => Carbon::now()->subDays(10),
                'valid_until' => Carbon::now()->subDays(1),
            ],
        ];

        foreach ($coupons as $coupon) {
            if (!Coupon::where('code', $coupon['code'])->exists()) {
                Coupon::create($coupon);
                $this->command->info("✅ Coupon created: {$coupon['code']}");
            } else {
                $this->command->info("ℹ️ Coupon already exists: {$coupon['code']}, skipping...");
            }
        }

        // Optionally, create 5 random coupons
        Coupon::factory()->count(5)->create();
        $this->command->info("✅ 5 random coupons created");
    }
}
