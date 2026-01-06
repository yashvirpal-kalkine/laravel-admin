<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cart
    ) {
    }

    public function index()
    {
        $cart = $this->cart->getCart();
        $cart->load('items.product');

        return view('frontend.cart', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1|max:100'
        ]);

        $item = $this->cart->add($product, $request->quantity ?? 1);

        return response()->json([
            'success' => true,
            'message' => 'Added to cart',
            'cart_count' => $this->cart->count(),
            'item' => $item
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:100'
        ]);

        $this->cart->update($product, $request->quantity);

        return response()->json([
            'success' => true,
            'cart_count' => $this->cart->count(),
            'product_subtotal' => $this->cart->itemSubtotal($product),
            'cart_total' => $this->cart->total()
        ]);
    }

    public function remove(Product $product)
    {
        $this->cart->remove($product);

        return response()->json([
            'success' => true,
            'cart_total' => $this->cart->total(),
            'cart_count' => $this->cart->count()
        ]);
    }

    public function mini()
    {
        $cart = $this->cart->getCart();
        $cart->load('items.product');

        return response()->json([
            'success' => true,
            'html' => view('components.frontend.mini-cart', compact('cart'))->render(),
            'cart_count' => $this->cart->count()
        ]);
    }

    public function productQty(Product $product)
    {
        return response()->json([
            'qty' => $this->cart->getProductQty($product)
        ]);
    }




}

