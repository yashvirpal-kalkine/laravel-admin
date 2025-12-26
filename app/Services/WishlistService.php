<?php

namespace App\Services;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class WishlistService
{
    protected function cacheKey(): string
    {
        return 'wishlist_products_' . Auth::id();
    }

    /**
     * Get all wishlisted product IDs for current user
     */
    public function productIds(): array
    {
        if (!Auth::check()) {
            return [];
        }

        return Cache::remember(
            $this->cacheKey(),
            now()->addMinutes(10),
            fn() => Wishlist::where('user_id', Auth::id())
                ->where('wishlistable_type', Product::class)
                ->pluck('wishlistable_id')
                ->toArray()
        );
    }

    /**
     * Toggle wishlist status for a model
     */
    public function toggle(Model $model): string
    {
        $user = Auth::user();

        $existing = Wishlist::where([
            'user_id' => $user->id,
            'wishlistable_id' => $model->id,
            'wishlistable_type' => get_class($model),
        ])->first();

        if ($existing) {
            $existing->delete();
            Cache::forget($this->cacheKey()); // ✅ clear cache
            return 'removed';
        }

        Wishlist::create([
            'user_id' => $user->id,
            'wishlistable_id' => $model->id,
            'wishlistable_type' => get_class($model),
        ]);

        Cache::forget($this->cacheKey()); // ✅ clear cache
        return 'added';
    }

    /**
     * Check if model is wishlisted (uses cache)
     */
    public function isWishlisted(Model $model): bool
    {
        if (!Auth::check()) {
            return false;
        }

        return in_array($model->id, $this->productIds());
    }

    /**
     * Wishlist count
     */
    public function count(): int
    {
        return count($this->productIds());
    }

    public function attachWishlistFlag(iterable $products): iterable
    {
        if (!Auth::check()) {
            foreach ($products as $product) {
                $product->is_wishlisted = false;
            }
            return $products;
        }

        $ids = Wishlist::where('user_id', Auth::id())
            ->where('wishlistable_type', Product::class)
            ->pluck('wishlistable_id')
            ->toArray();

        foreach ($products as $product) {
            $product->is_wishlisted = in_array($product->id, $ids);
        }

        return $products;
    }
    public function attachWishlistFlagSingle(Model $product): Model
    {
        $product->is_wishlisted = false;

        if (Auth::check()) {
            $product->is_wishlisted = Wishlist::where([
                'user_id' => Auth::id(),
                'wishlistable_id' => $product->id,
                'wishlistable_type' => get_class($product),
            ])->exists();
        }

        return $product;
    }


}
