<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'sku',
        'short_description',
        'description',
        'featured_image',
        'alt',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'price',
        'discount_price',
        'stock',
        'is_featured',
        'status',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_product');
    }

    public function tags()
    {
        return $this->belongsToMany(ProductTag::class, 'product_product_tag');
    }
}
