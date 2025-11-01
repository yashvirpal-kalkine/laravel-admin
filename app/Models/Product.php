<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'sku',
        'regular_price',
        'sale_price',
        'stock',
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
        'custom_field',
        'is_featured',
        'status',
        'author_id',
        'brand_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function brand()
    {
        return $this->belongsTo(ProductBrand::class, 'brand_id');
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_product');
    }

    public function tags()
    {
        return $this->belongsToMany(ProductTag::class, 'product_product_tag');
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class)->orderBy('sort_order');
    }

    public function mainImage()
    {
        return $this->hasOne(ProductGallery::class)->where('is_default', true);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function finalPrice()
    {
        return $this->sale_price && $this->sale_price < $this->regular_price
            ? $this->sale_price
            : $this->regular_price;
    }
    public function discountPercentage()
    {
        if (!$this->sale_price || $this->regular_price == 0)
            return 0;
        return round((($this->regular_price - $this->sale_price) / $this->regular_price) * 100, 2);
    }
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    //$featuredProducts = Product::featured()->take(10)->get();

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : asset('images/default-product.png');
    }
    public function getBannerUrlAttribute()
    {
        return $this->banner ? Storage::url($this->banner) : asset('images/default-banner.png');
    }


}
