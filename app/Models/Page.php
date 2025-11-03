<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'template',
        'short_description',
        'description',
        'banner',
        'alt',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'seo_image',
        'canonical_url',
        'status',
        'author_id',
        'custom_field',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'parent_id' => 'integer',
    ];

    /**
     * Automatically generate unique slug when creating or updating title.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = static::generateSlug($page->title);
            }
        });

        static::updating(function ($page) {
            if ($page->isDirty('title') && empty($page->slug)) {
                $page->slug = static::generateSlug($page->title);
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

    /**
     * Parent Page (Self Relation)
     */
    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    /**
     * Children Pages
     */
    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function activeChildren()
    {
        return $this->hasMany(Page::class, 'parent_id')
            ->where('status', 1)
            ->orderBy('title');
    }

    public function getDescendantIds()
    {
        $ids = [];

        foreach ($this->children()->get() as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $child->getDescendantIds());
        }

        return $ids;
    }



    /**
     * Author Relation
     */
    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
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

    /**
     * Dynamically create accessors for *_url attributes.
     */
    public function __get($key)
    {
        // If accessing one of our *_url attributes dynamically
        if (Str::endsWith($key, '_url')) {
            $baseField = Str::beforeLast($key, '_url');
            if (in_array($baseField, self::$imageFields)) {
                return $this->generateImageUrl($this->{$baseField});
            }
        }

        return parent::__get($key);
    }

}
