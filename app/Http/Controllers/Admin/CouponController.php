<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class CouponController extends Controller
{


    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        $user = Auth::user();
        if ($user->role_id === 1) {
            return view('admin.coupons.index', compact('coupons'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }


    public function create()
    {
        $user = Auth::user();
        if ($user->role_id === 1) {
            return view('admin.coupons.create');
        } else {
            return back()->with('error', 'Access denied!');
        };
    }


    public function store(StoreCouponRequest $request)
    {
        $user = Auth::user();
        Coupon::query()->create($request->all());
        if ($user->role_id === 1) {
            return redirect()->route('admin.coupons.index')->with('success', 'Coupon added successfully');
        } else {
            return back()->with('error', 'Access denied!');
        };
    }


    public function edit($id)
    {
        $user = Auth::user();
        $coupon = Coupon::findOrFail($id);
        if ($user->role_id === 1) {
            return view('admin.coupons.edit', compact('coupon'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }


    public function update(UpdateCouponRequest $request, $id)
    {        
        $coupon = Coupon::findOrFail($id);

        $validatedData = $request->validated(); // Sử dụng validated() để lấy dữ liệu đã kiểm tra        

        $coupon->update($request->all());

        $user = Auth::user();
        if ($user->role_id === 1) {
            return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully');
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'is_active' => 'required'
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->update([
            'is_active' => $request->is_active
        ]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }


    public function destroy($id)
    {
        $user = Auth::user();
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        if ($user->role_id === 1) {


            return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully');
        } else {
            return back()->with('error', 'Access denied!');
        };
    }
}
