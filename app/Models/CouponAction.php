<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon_id',
        'action',
        'value',
        'product_id',
        'quantity',
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

