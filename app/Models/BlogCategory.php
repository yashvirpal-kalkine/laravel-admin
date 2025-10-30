<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
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

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = static::generateSlug($category->title);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('title') && empty($category->slug)) {
                $category->slug = static::generateSlug($category->title);
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

    /**
     * Relationships
     */
    public function children()
    {
        return $this->hasMany(BlogCategory::class, 'parent_id');
    }
    /**
     * Get all descendant category IDs (recursive)
     */
    public function getDescendantIds()
    {
        $ids = [];

        foreach ($this->children()->get() as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $child->getDescendantIds());
        }

        return $ids;
    }


    public function parent()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }
}
