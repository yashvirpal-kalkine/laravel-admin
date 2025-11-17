<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    /**
     * Display a listing of coupons.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Coupon::query()->orderByDesc('id');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('value', function ($coupon) {
                    if ($coupon->type === 'percentage') {
                        return $coupon->value . '%';
                    } elseif ($coupon->type === 'fixed') {
                        return currencyformat($coupon->value);
                    }
                    return $coupon->value;
                })
                ->addColumn('valid_from', fn($coupon) => dateFormat($coupon->valid_from))
                ->addColumn('valid_until', fn($coupon) => dateFormat($coupon->valid_until))
                ->addColumn('status', fn($coupon) => status_badge($coupon->status))
                ->addColumn('actions', function ($coupon) {
                    $edit = '<a href="' . route('admin.coupons.edit', $coupon->id) . '" class="btn btn-sm btn-primary me-1" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                             </a>';
                    $delete = '<form method="POST" action="' . route('admin.coupons.destroy', $coupon->id) . '" style="display:inline;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')" title="Delete">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                               </form>';
                    return $edit . $delete;
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('admin.ecommerce.coupons.index');
    }

    /**
     * Show the form for creating a new coupon.
     */
    public function create()
    {
        return view('admin.ecommerce.coupons.form');
    }

    /**
     * Store a newly created coupon in storage.
     */
    public function store(CouponRequest $request)
    {
        DB::beginTransaction();

        try {
            Coupon::create($request->validated());

            DB::commit();
            return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Coupon creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withInput()->with('error', 'Failed to create coupon. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified coupon.
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.ecommerce.coupons.form', compact('coupon'));
    }

    /**
     * Update the specified coupon in storage.
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        DB::beginTransaction();

        try {
            $coupon->update($request->validated());

            DB::commit();
            return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Coupon update failed', [
                'coupon_id' => $coupon->id,
                'error' => $e->getMessage(),
            ]);

            return back()->withInput()->with('error', 'Failed to update coupon. Please try again.');
        }
    }

    /**
     * Remove the specified coupon from storage.
     */
    public function destroy(Coupon $coupon)
    {
        DB::beginTransaction();

        try {
            $coupon->delete();

            DB::commit();
            return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Coupon deletion failed', [
                'coupon_id' => $coupon->id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Failed to delete coupon. Please try again.');
        }
    }
}
