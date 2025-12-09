<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;

class CartService
{
    protected Cart $cart;

    public function getCart(): Cart
    {
        if (isset($this->cart)) {
            return $this->cart;
        }

        // Logged in user
        if (auth()->check()) {
            return $this->cart = Cart::firstOrCreate([
                'user_id' => auth()->id()
            ]);
        }

        // Guest user
        $sessionId = session()->get('cart_session');

        if (!$sessionId) {
            $sessionId = (string) Str::uuid();
            session(['cart_session' => $sessionId]);
        }

        return $this->cart = Cart::firstOrCreate([
            'session_id' => $sessionId
        ]);
    }

    public function add(Product $product, int $qty = 1)
    {
        $cart = $this->getCart();

        $item = $cart->items()->firstOrNew([
            'product_id' => $product->id
        ]);

        $item->quantity += $qty;
        $item->price = $product->sale_price ?? $product->regular_price;
        $item->save();

        return $item;
    }

    public function update(Product $product, int $qty)
    {
        if ($qty < 1) {
            return $this->remove($product);
        }

        $this->getCart()
            ->items()
            ->where('product_id', $product->id)
            ->update(['quantity' => $qty]);
    }

    public function remove(Product $product)
    {
        $this->getCart()
            ->items()
            ->where('product_id', $product->id)
            ->delete();
    }

    public function count(): int
    {
        return $this->getCart()
            ->items()
            ->sum('quantity');
    }
    public function itemCount()
    {
        return $this->getCart()->items()->sum('quantity');
    }
}



