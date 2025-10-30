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

    //For Exclude from Drom in admin Edit 
    public function allChildren()
    {
        return $this->hasMany(Page::class, 'parent_id')->with('allChildren');
    }

    public function descendantIds()
    {
        $ids = [];

        foreach ($this->allChildren as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $child->descendantIds());
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
}
