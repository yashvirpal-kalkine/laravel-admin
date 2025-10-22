<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PDF;

use Yajra\DataTables\Facades\DataTables;
class TransactionController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Transaction::with('order')->latest();

            return DataTables::of($query)
                ->addIndexColumn()

                ->addColumn('order', function ($transaction) {
                    return $transaction->order?->order_number ?? '—';
                })

                ->addColumn('transaction_id', function ($transaction) {
                    return $transaction->transaction_id ?? '—';
                })

                ->addColumn('amount', function ($transaction) {
                    return currencyformat($transaction->amount);
                })

                ->addColumn('method', function ($transaction) {
                    return ucfirst($transaction->payment_method ?? 'N/A');
                })

                ->addColumn('status', function ($transaction) {
                    $color = match ($transaction->status) {
                        'completed' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        default => 'secondary',
                    };
                    return '<span class="badge bg-' . $color . '">' . ucfirst($transaction->status) . '</span>';
                })

                ->addColumn('date', function ($transaction) {
                    return dateFormat($transaction->created_at);
                })

                ->addColumn('action', function ($transaction) {
                    $edit = '<a href="' . route('admin.transactions.edit', $transaction->id) . '" 
                            class="btn btn-sm btn-warning me-1" title="Edit">
                            <i class="bi bi-pencil text-white"></i>
                         </a>';

                    $invoice = '<a href="' . route('admin.transactions.invoice', $transaction->id) . '" 
                            class="btn btn-sm btn-info me-1" target="_blank" title="Invoice">
                            <i class="bi bi-file-earmark-pdf"></i>
                         </a>';

                    $delete = '<form action="' . route('admin.transactions.destroy', $transaction->id) . '" 
                            method="POST" style="display:inline;" 
                            onsubmit="return confirm(\'Delete this transaction?\');">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button class="btn btn-sm btn-danger" title="Delete">
                                <i class="bi bi-trash text-white"></i>
                            </button>
                           </form>';

                    return $edit . $invoice . $delete;
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.ecommerce.transactions.index');
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
