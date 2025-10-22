<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Coupon::query()->orderByDesc('id');

            return DataTables::of($query)
                ->addIndexColumn() // Serial number

                ->addColumn('value', function ($coupon) {
                    if ($coupon->type === 'percentage') {
                        return $coupon->value . '%';
                    } elseif ($coupon->type === 'fixed') {
                        return  currencyformat($coupon->value);
                    }
                    return $coupon->value; // fallback
                })

                ->addColumn('valid_from', function ($coupon) {
                    return dateFormat($coupon->valid_from); // call your helper
                })
                ->addColumn('valid_until', function ($coupon) {
                    return dateFormat($coupon->valid_until);
                })
                ->addColumn('status', function ($coupon) {
                    return status_badge($coupon->status); // your helper
                })
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
    public function create()
    {
        return view('admin.ecommerce.coupons.form');
    }

    public function store(CouponRequest $request)
    {
        Coupon::create($request->validated());
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.ecommerce.coupons.form', compact('coupon'));
    }

    public function update(CouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->validated());
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
