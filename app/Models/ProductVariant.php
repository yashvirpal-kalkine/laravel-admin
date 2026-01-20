<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'sku',
        'regular_price',
        'sale_price',
        'stock',
        'image',
        'image_alt',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function values()
    {
        return $this->belongsToMany(ProductAttributeValue::class, 'product_variant_values', 'variant_id', 'attribute_value_id');
    }

    // Helper to show attribute names
    public function formattedAttributes()
    {
        return $this->values->map(fn($v) => $v->attribute->name . ': ' . $v->value)->join(' | ');
    }
}
