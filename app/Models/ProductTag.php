<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'status',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Relation with products (pivot will be created later)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_product_tag');
    }
}
