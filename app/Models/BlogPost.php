<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'banner',
        'banner_alt',
        'image',
        'image_alt',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'seo_image',
        'canonical_url',
        'custom_field',
        'is_featured',
        'status',
        'author_id',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Author relation
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Many-to-Many with categories
    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_post_category', 'post_id', 'category_id');
    }

    // Many-to-Many with tags
    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tag', 'post_id', 'tag_id');
    }


    /**
     * Automatically append URL fields for image-related columns.
     */
    protected $appends = ['image_url', 'banner_url', 'seo_image_url'];

    /**
     * Define which attributes represent images.
     */
    protected static $imageFields = ['image', 'banner', 'seo_image'];

    /**
     * Common image URL generator.
     */
    protected function generateImageUrl(?string $filename): ?string
    {
        return !empty($filename) ? image_url('page', $filename, 'large') : null;
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->generateImageUrl($this->image);
    }

    public function getBannerUrlAttribute(): ?string
    {
        return $this->generateImageUrl($this->banner);
    }

    public function getSeoImageUrlAttribute(): ?string
    {
        return $this->generateImageUrl($this->seo_image);
    }

}
