<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Calculator extends Model
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
        'faqs',
        'form_type'
    ];

    protected $casts = [
        'status' => 'boolean',
        'faqs' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($calculator) {
            if (empty($calculator->slug)) {
                $calculator->slug = static::generateSlug($calculator->title);
            }
        });

        static::updating(function ($calculator) {
            if ($calculator->isDirty('title') && empty($calculator->slug)) {
                $calculator->slug = static::generateSlug($calculator->title);
            }
        });
    }

    /**
     * Generate unique slug.
     */
    public static function generateSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    /**
     * Only active (published) pages.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }
}
