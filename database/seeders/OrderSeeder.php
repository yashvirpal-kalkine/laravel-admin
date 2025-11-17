<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->info('ℹ️ No users or products found, skipping order seeding.');
            return;
        }

        // Create 10 orders
        for ($i = 1; $i <= 10; $i++) {
            $user = $users->random();

            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'user_id' => $user->id,
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'customer_phone' => '1234567890',
                'shipping_address' => $user->addresses()->where('type', 'shipping')->first()?->address_line1 ?? 'Default Shipping Address',
                'billing_address' => $user->addresses()->where('type', 'billing')->first()?->address_line1 ?? 'Default Billing Address',
                'subtotal' => 0,
                'discount' => 0,
                'tax' => 0,
                'total' => 0,
                'status' => ['pending', 'processing', 'completed', 'cancelled'][rand(0, 3)],
            ]);

            $this->command->info("✅ Order created: {$order->order_number}");

            // Add 1-5 random products as order items
            $selectedProducts = $products->random(rand(1, 5));
            $subtotal = 0;

            foreach ($selectedProducts as $product) {
                $quantity = rand(1, 3);
                $price = $product->sale_price ?: $product->regular_price ?: 0;
                $total = $price * $quantity;
                $subtotal += $total;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total' => $total,
                ]);
            }

            $tax = round($subtotal * 0.1, 2); // 10% tax
            $discount = round($subtotal * 0.05, 2); // 5% discount
            $total = $subtotal + $tax - $discount;

            // Update order totals
            $order->update([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => $discount,
                'total' => $total,
            ]);

            // Create transaction for the order
            Transaction::create([
                'order_id' => $order->id,
                'transaction_id' => 'TXN-' . strtoupper(Str::random(10)),
                'amount' => $total,
                'payment_method' => ['cash', 'card', 'upi', 'wallet'][rand(0, 3)],
                'status' => ['success', 'failed'][rand(0, 1)],
            ]);
        }

        $this->command->info("✅ 10 orders with items and transactions created");
    }
}
