<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('session_id')->nullable();
            $table->decimal('subtotal', 10, 2)->default(0);   // sum of items
            $table->decimal('discount_total', 10, 2)->default(0); // coupon impact
            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->decimal('tax_total', 10, 2)->default(0);
            $table->string('shipping_method')->nullable();
            $table->string('shipping_label')->nullable(); 
            $table->decimal('shipping_total', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2)->default(0); // final payable
            $table->timestamps();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->index(['cart_id', 'product_id']);
            $table->foreignId('cart_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->unique(['cart_id', 'product_id']);
        });

        Schema::create('cart_coupons', function (Blueprint $table) {
            $table->id();
            $table->index(['cart_id', 'coupon_id']);
            $table->foreignId('cart_id')->constrained()->cascadeOnDelete();
            $table->foreignId('coupon_id')->constrained()->cascadeOnDelete();
            $table->unique(['cart_id', 'coupon_id']);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_coupons');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');

    }
};
