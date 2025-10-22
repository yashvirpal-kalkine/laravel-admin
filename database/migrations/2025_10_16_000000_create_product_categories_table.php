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
            $table->string('short_description')->nullable();
            $table->longText('description')->nullable();

            // Image fields
            $table->string('banner')->nullable();
            $table->string('alt')->nullable();

            // SEO fields
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            // Hierarchy
            $table->foreignId('parent_id')->nullable()->constrained('product_categories')->nullOnDelete();

            // Status + Author
            $table->boolean('status')->default(true)->default(1);
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
