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
        return response()->json($coupons);
    }

    public function create()
    {
        return response()->json();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|unique:coupons',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);

        $coupon = Coupon::create($validatedData);

        return response()->json([
            'message' => 'Coupon added successfully',
            'coupon' => $coupon
        ], 201);
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return response()->json($coupon);
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

        return response()->json([
            'message' => 'Coupon updated successfully',
            'coupon' => $coupon
        ]);
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return response()->json(['message' => 'Coupon deleted successfully']);
    }
}
