<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;
use App\Models\CouponRule;
use App\Models\CouponAction;
use Illuminate\Support\Str;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        // -----------------------------
        // 1. Fixed discount coupon
        // -----------------------------
        $fixed = Coupon::create([
            'title' => 'Flat 200 OFF',
            'code' => 'FLAT200',
            'status' => 1,
            'starts_at' => now(),
            'expires_at' => now()->addMonth(),
            'usage_limit' => 100,
        ]);

        CouponRule::create([
            'coupon_id' => $fixed->id,
            'condition' => 'cart_subtotal',
            'min_value' => 500, // min cart subtotal
        ]);

        CouponAction::create([
            'coupon_id' => $fixed->id,
            'action' => 'fixed_discount',
            'value' => 200,
        ]);

        // -----------------------------
        // 2. Percentage discount coupon
        // -----------------------------
        $percent = Coupon::create([
            'title' => '10% Off',
            'code' => 'SAVE10',
            'status' => 1,
            'starts_at' => now(),
            'expires_at' => now()->addMonth(),
            'usage_limit' => 100,
        ]);

        CouponRule::create([
            'coupon_id' => $percent->id,
            'condition' => 'cart_subtotal',
            'min_value' => 1000,
        ]);

        CouponAction::create([
            'coupon_id' => $percent->id,
            'action' => 'percentage_discount',
            'value' => 10,
        ]);

        // -----------------------------
        // 3. Buy 1 Get 1 Free (Same product)
        // -----------------------------
        $bogo = Coupon::create([
            'title' => 'BOGO - Product 1',
            'code' => 'BOGO2026',
            'status' => 1,
            'starts_at' => now(),
            'expires_at' => now()->addMonth(),
        ]);

        CouponRule::create([
            'coupon_id' => $bogo->id,
            'condition' => 'product',
            'product_id' => 1, // Product ID to buy
            'min_qty' => 1,
        ]);

        CouponAction::create([
            'coupon_id' => $bogo->id,
            'action' => 'free_product',
            'product_id' => 1, // Same product free
            'quantity' => 1,
        ]);

        // -----------------------------
        // 4. Buy Product 1 Get Product 2 Free
        // -----------------------------
        $buyXgetY = Coupon::create([
            'title' => 'Buy 1 Get Product 2 Free',
            'code' => 'BUY1GET2',
            'status' => 1,
            'starts_at' => now(),
            'expires_at' => now()->addMonth(),
        ]);

        CouponRule::create([
            'coupon_id' => $buyXgetY->id,
            'condition' => 'product',
            'product_id' => 1, // Buy this
            'min_qty' => 1,
        ]);

        CouponAction::create([
            'coupon_id' => $buyXgetY->id,
            'action' => 'free_product',
            'product_id' => 2, // Get this free
            'quantity' => 1,
        ]);
    }
}
