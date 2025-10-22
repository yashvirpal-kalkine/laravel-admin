<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.ecommerce.orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::pluck('title', 'id');
        return view('admin.ecommerce.orders.form', compact('products'));
    }

    public function store(OrderRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $subtotal = 0;

            foreach ($data['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                $subtotal += $product->price * $item['quantity'];
            }

            $orderData = [
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'],
                'shipping_address' => $data['shipping_address'],
                'billing_address' => $data['billing_address'],
                'subtotal' => $subtotal,
                'discount' => 0,
                'tax' => $subtotal * 0.18,
                'total' => $subtotal + ($subtotal * 0.18),
                'status' => $data['status'],
                'order_number' => strtoupper(Str::random(10)),
            ];

            $order = Order::create($orderData);

            foreach ($data['items'] as $item) {
                $product = Product::find($item['product_id']);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'total' => $product->price * $item['quantity'],
                ]);
            }

            if (!empty($data['transaction'])) {
                Transaction::create(array_merge($data['transaction'], ['order_id' => $order->id]));
            }
        });

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'transaction', 'user']);
        return view('admin.ecommerce.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $products = Product::pluck('title', 'id');
        $order->load('items', 'transaction');
        return view('admin.ecommerce.orders.form', compact('order', 'products'));
    }

    public function update(OrderRequest $request, Order $order)
    {
        DB::transaction(function () use ($request, $order) {
            $data = $request->validated();
            $subtotal = 0;

            foreach ($data['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                $subtotal += $product->price * $item['quantity'];
            }

            $orderData = [
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'],
                'shipping_address' => $data['shipping_address'],
                'billing_address' => $data['billing_address'],
                'subtotal' => $subtotal,
                'discount' => 0,
                'tax' => $subtotal * 0.18,
                'total' => $subtotal + ($subtotal * 0.18),
                'status' => $data['status'],
            ];

            $order->update($orderData);

            $order->items()->delete();
            foreach ($data['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'total' => $product->price * $item['quantity'],
                ]);
            }

            if (!empty($data['transaction'])) {
                if ($order->transaction) {
                    $order->transaction()->update($data['transaction']);
                } else {
                    $order->transaction()->create($data['transaction']);
                }
            }
        });

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
