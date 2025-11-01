<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('sku')->unique()->nullable();

            // Pricing
            $table->decimal('regular_price', 10, 2)->default(0);
            $table->decimal('sale_price', 10, 2)->nullable();

            // Inventory
            $table->integer('stock')->default(0);

            // Descriptions
            $table->string('short_description')->nullable();
            $table->longText('description')->nullable();

            // Images
            $table->string('banner')->nullable();
            $table->string('banner_alt')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();

            // SEO fields
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('seo_image')->nullable();
            $table->string('canonical_url')->nullable();

            // Misc
            $table->string('custom_field')->nullable();
            $table->boolean('is_featured')->default(false);

            // Status & Author
            $table->boolean('status')->default(true);
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('product_brands')->nullOnDelete();


            $table->timestamps();
        });

        Schema::create('product_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('image'); // filename or path
            $table->string('alt')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        // Pivot: product-category
        Schema::create('product_category_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('product_category_id')->constrained('product_categories')->cascadeOnDelete();
            $table->unique(['product_id', 'product_category_id']);
            $table->timestamps();
        });

        // Pivot: product-tag
        Schema::create('product_product_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('product_tag_id')->constrained('product_tags')->cascadeOnDelete();
            $table->unique(['product_id', 'product_tag_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_product_tag');
        Schema::dropIfExists('product_category_product');
        Schema::dropIfExists('products');
    }
};
