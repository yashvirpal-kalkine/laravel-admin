<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('wishlistable')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // Used only for UI (heart color)
        $wishlistedProductIds = $wishlists->pluck('wishlistable_id')->toArray();

        return view('frontend.wishlist', compact(
            'wishlists',
            'wishlistedProductIds'
        ));
    }

    public function toggle(Product $product)
    {
        $userId = Auth::id();

        $wishlist = Wishlist::where([
            'user_id' => $userId,
            'wishlistable_id' => $product->id,
            'wishlistable_type' => Product::class,
        ])->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['status' => 'removed']);
        }

        Wishlist::create([
            'user_id' => $userId,
            'wishlistable_id' => $product->id,
            'wishlistable_type' => Product::class,
        ]);

        return response()->json(['status' => 'added']);
    }

    public function count()
    {
        return response()->json([
            'success' => true,
            'html' => Wishlist::where('user_id', Auth::id())->count()
        ]);
    }
}
