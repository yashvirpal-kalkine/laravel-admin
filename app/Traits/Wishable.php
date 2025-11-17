<?php
namespace App\Traits;

use App\Models\Wishlist;

trait Wishable
{
    public function wishlists()
    {
        return $this->morphMany(Wishlist::class, 'wishlistable');
    }

    public function isWishlistedBy($user)
    {
        return $this->wishlists()->where('user_id', $user->id)->exists();
    }
}
