<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
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
        'author_id',
    ];

    // Author relation
    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }
}
