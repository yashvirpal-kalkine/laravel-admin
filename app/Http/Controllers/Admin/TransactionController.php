<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PDF; 

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('order');

        // Search by order number or transaction ID
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('transaction_id', 'like', "%{$search}%")
                    ->orWhereHas('order', fn($o) => $o->where('order_number', 'like', "%{$search}%"));
            });
        }

        $transactions = $query->orderByDesc('id')->paginate(10);
        $transactions->appends($request->all());

        return view('admin.ecommerce.transactions.index', compact('transactions', 'search'));
    }

    public function create()
    {
        $orders = Order::latest()->pluck('order_number', 'id');
        return view('admin.ecommerce.transactions.form', compact('orders'));
    }

    public function store(TransactionRequest $request)
    {
        Transaction::create($request->validated());
        return redirect()->route('admin.transactions.index')->with('success', 'Transaction added successfully.');
    }

    public function edit(Transaction $transaction)
    {
        $orders = Order::latest()->pluck('order_number', 'id');
        return view('admin.ecommerce.transactions.form', compact('transaction', 'orders'));
    }

    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());
        return redirect()->route('admin.transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('admin.transactions.index')->with('success', 'Transaction deleted successfully.');
    }

    public function invoice(Transaction $transaction)
    {
        $transaction->load('order'); // Eager load order data

        $pdf = PDF::loadView('admin.ecommerce.transactions.invoice', compact('transaction'));

        // Download as PDF
        return $pdf->download('Invoice_' . $transaction->transaction_id . '.pdf');
    }
}
