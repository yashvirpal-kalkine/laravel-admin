<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
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
        'seo_image',
        'canonical_url',
        'status',
        'published_at',
        'author_id',
        'template',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Author relationship
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
