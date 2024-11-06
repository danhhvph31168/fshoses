<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
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

    public function store(StoreCouponRequest $request)
    {

            Coupon::query()->create($request->all());
            return redirect()->route('admin.coupons.index')->with('success', 'Coupon added successfully');

    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(UpdateCouponRequest $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $validatedData = $request->validated(); // Sử dụng validated() để lấy dữ liệu đã kiểm tra

        $coupon->update($validatedData);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully');
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully');
    }
}
