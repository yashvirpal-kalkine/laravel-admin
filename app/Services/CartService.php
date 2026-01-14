<?php
namespace App\Services;

use App\Models\Cart;
//use App\Models\Cart as Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CartService
{
    protected Cart $cart;



    public function getCart(): Cart
    {
        if (isset($this->cart)) {
            return $this->cart;
        }

        if (Auth::check()) {
            return $this->cart = Cart::firstOrCreate([
                'user_id' => Auth::id()
            ]);
        }

        $sessionId = session()->get('cart_session');

        if (!$sessionId) {
            $sessionId = (string) Str::uuid();
            session(['cart_session' => $sessionId]);
        }

        return $this->cart = Cart::firstOrCreate([
            'session_id' => $sessionId
        ]);
    }

    public function mergeGuestCartIntoUserCart()
    {
        if (!Auth::check())
            return;

        $userCart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $sessionId = session()->get('cart_session');
        if (!$sessionId)
            return;

        $guestCart = Cart::where('session_id', $sessionId)->first();
        if (!$guestCart)
            return;

        foreach ($guestCart->items as $item) {
            $existing = $userCart->items()->where('product_id', $item->product_id)->first();

            if ($existing) {
                $existing->update([
                    'quantity' => $existing->quantity + $item->quantity
                ]);
            } else {
                $item->cart_id = $userCart->id;
                $item->save();
            }
        }

        // Delete guest cart and clear session
        $guestCart->delete();
        session()->forget('cart_session');

        // Update CartService internal state
        $this->cart = $userCart;
    }



    public function add(Product $product, int $qty = 1)
    {
        $cart = $this->getCart();

        $item = $cart->items()->firstOrNew([
            'product_id' => $product->id
        ]);

        $item->quantity = max(1, $item->quantity + $qty);
        $item->price = $product->sale_price ?? $product->regular_price;
        $item->save();

        return $item;
    }

    public function update(Product $product, int $qty)
    {
        if ($qty < 1) {
            return $this->remove($product);
        }

        $this->getCart()->items()->where('product_id', $product->id)->update(['quantity' => $qty]);
    }

    public function remove(Product $product)
    {
        $this->getCart()->items()->where('product_id', $product->id)->delete();
    }

    public function count(): int
    {
        return $this->getCart()->items()->sum('quantity');
    }

    // App\Services\CartService.php

    public function itemSubtotal(Product $product): float
    {
        $item = $this->getCart()->items()->where('product_id', $product->id)->first();

        if (!$item) {
            return 0;
        }

        return $item->price * $item->quantity;
    }
    public function total(): float
    {
        return (float) $this->getCart()->items()->sum(\DB::raw('price * quantity'));

    }

    public function getProductQty(Product $product): int
    {
        return (int) ($this->getCart()->items()->where('product_id', $product->id)->value('quantity') ?? 0);
    }


    public function getProductQtyMap(): array
    {
        return $this->getCart()->items()->pluck('quantity', 'product_id')->toArray();
    }

    // App\Services\CartService.php

    public function attachCartQtyToProducts($products)
    {
        $cart = $this->getCart();
        $qtyMap = $cart->items()->pluck('quantity', 'product_id'); // [id => qty]

        // If single product
        if ($products instanceof \Illuminate\Database\Eloquent\Model) {
            $products->cart_qty = $qtyMap[$products->id] ?? 0;
            return $products;
        }

        // If Eloquent Collection or Paginator
        $collection = $products instanceof \Illuminate\Pagination\LengthAwarePaginator
            ? $products->getCollection()
            : $products;

        foreach ($collection as $product) {
            $product->cart_qty = $qtyMap[$product->id] ?? 0;
        }

        return $products;
    }




}



