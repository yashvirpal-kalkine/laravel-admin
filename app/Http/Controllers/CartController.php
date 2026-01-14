<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cart
    ) {}

    public function index()
    {
        $cart = $this->cart->getCart();
        $cart->load('items.product');

        return view('frontend.cart', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        try {
            $request->validate([
                'quantity' => 'nullable|integer|min:1|max:100'
            ]);

            $item = $this->cart->add($product, $request->quantity ?? 1);

            return response()->json([
                'status' => true,
                'message' => 'Added to cart',
                'cart_count' => $this->cart->count(),
                'item' => $item
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' => 'Could not add item to cart'
            ], 500);
        }
    }

    public function update(Request $request, Product $product)
    {
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1|max:100'
            ]);

            $this->cart->update($product, $request->quantity);

            return response()->json([
                'status' => true,
                'cart_count' => $this->cart->count(),
                'product_subtotal' => $this->cart->itemSubtotal($product),
                'cart_total' => $this->cart->total(),
                'message' => 'Cart updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' => 'Could not update cart item'
            ], 500);
        }
    }

    public function remove(Product $product)
    {
        try {
            $this->cart->remove($product);

            return response()->json([
                'status' => true,
                'cart_total' => $this->cart->total(),
                'cart_count' => $this->cart->count(),
                'message' => 'Item removed from cart'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' => 'Could not remove item from cart'
            ], 500);
        }
    }

    public function mini()
    {
        try {
            $cart = $this->cart->getCart();
            $cart->load('items.product');

            return response()->json([
                'status' => true,
                'html' => view('components.frontend.mini-cart', compact('cart'))->render(),
                'cart_count' => $this->cart->count(),
                'message' => 'Mini cart loaded successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' => 'Could not load mini cart'
            ], 500);
        }
    }

    public function productQty(Product $product)
    {
        try {
            return response()->json([
                'status' => true,
                'qty' => $this->cart->getProductQty($product),
                'message' => 'Product quantity retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' => 'Could not retrieve product quantity'
            ], 500);
        }
    }
}
