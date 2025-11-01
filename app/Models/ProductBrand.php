<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductBrand extends Model
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

        'status',
        'author_id',
        'custom_field',
    ];

    /**
     * Auto-generate unique slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($brand) {
            if (empty($brand->slug)) {
                $brand->slug = static::generateSlug($brand->title);
            }
        });

        static::updating(function ($brand) {
            if ($brand->isDirty('title') && empty($brand->slug)) {
                $brand->slug = static::generateSlug($brand->title);
            }
        });
    }

    /**
     * Generate unique slug
     */
    public static function generateSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
