<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('parent_id')->nullable()->constrained('product_categories')->onDelete('cascade');
            $table->string('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('banner')->nullable();
            $table->string('banner_alt')->nullable();

            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('seo_image')->nullable();
            $table->string('canonical_url')->nullable();

            $table->boolean('status')->default(true)->default(1);
            $table->foreignId('author_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->boolean('is_featured')->default(false);

            $table->string('custom_field')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
