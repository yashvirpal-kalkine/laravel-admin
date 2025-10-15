<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'banner',
        'alt',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'status',
        'published_at',
        'author_id',
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
}
