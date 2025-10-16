<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $query = Coupon::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%");
        }

        $coupons = $query->orderBy('id', 'desc')->paginate(10);
        $coupons->appends($request->all());

        return view('admin.ecommerce.coupons.index', compact('coupons', 'search'));
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
