<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    protected $fillable = [
        'title',
        'code',
        'status',
        'starts_at',
        'expires_at',
        'usage_limit',
        'used_count',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'status' => 'boolean',
    ];

    // Coupon rules (conditions)
    public function rules(): HasMany
    {
        return $this->hasMany(CouponRule::class);
    }

    // Coupon actions (discount/free product)
    public function actions(): HasMany
    {
        return $this->hasMany(CouponAction::class);
    }

    // Check if coupon is valid now
    public function isActive(): bool
    {
        $now = now();

        if (!$this->status)
            return false;
        if ($this->starts_at && $this->starts_at > $now)
            return false;
        if ($this->expires_at && $this->expires_at < $now)
            return false;

        if ($this->usage_limit && $this->used_count >= $this->usage_limit)
            return false;

        return true;
    }
}
