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
        Schema::create('calculators', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('form_type')->nullable();

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

            $table->string('custom_field')->nullable();
            $table->json('faqs')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculators');
    }
};
