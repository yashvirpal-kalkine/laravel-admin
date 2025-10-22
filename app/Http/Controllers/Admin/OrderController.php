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
        if ($request->ajax()) {
            $query = Order::with('user')->latest();

            return DataTables::of($query)
                ->addIndexColumn() // Serial number
                ->addColumn('customer', function ($order) {
                    return $order->user ? $order->user->name : '-';
                })
                ->addColumn('total', function ($order) {
                    return currencyformat($order->total);
                })
                ->addColumn('status', function ($order) {
                    $color = match ($order->status) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary',
                    };

                    return '<span class="badge bg-' . $color . ' text-capitalize px-3 py-2">' . $order->status . '</span>';
                })
                ->addColumn('created', function ($order) {
                    return dateFormat($order->created_at); // formatted date & time
                })
                ->addColumn('action', function ($order) {
                    $view = '<a href="' . route('admin.orders.show', $order->id) . '" class="btn btn-sm btn-info me-1 text-white" title="View">
                            <i class="bi bi-eye-fill"></i>
                         </a>';
                    $edit = '<a href="' . route('admin.orders.edit', $order->id) . '" class="btn btn-sm btn-warning me-1 text-white" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>';
                    $delete = '<form method="POST" action="' . route('admin.orders.destroy', $order->id) . '" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')" title="Delete">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                           </form>';
                    return $view . $edit . $delete;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.ecommerce.orders.index');
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
