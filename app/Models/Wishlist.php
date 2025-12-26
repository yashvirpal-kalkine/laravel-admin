<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'wishlistable_id',
        'wishlistable_type',
    ];

    /**
     * User who created the wishlist entry
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The wishlisted model (Product, Article, etc.)
     */
    public function wishlistable()
    {
        return $this->morphTo();
    }
}
