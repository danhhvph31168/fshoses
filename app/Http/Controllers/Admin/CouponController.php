<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|unique:coupons',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);

        $coupon = Coupon::create($validatedData);

        if ($coupon) {
            return redirect()->route('admin.coupons.index')->with('success', 'Coupon added');
        } else {
            return redirect()->route('admin.coupons.index')->with('error', 'Failed to add coupon');
        }
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $validatedData = $request->validate([
            'code' => 'required|string|unique:coupons,code,' . $id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);

        $coupon->update($validatedData);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated');
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted');
    }
}
