<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Auth;

class ProductSizeController extends Controller
{

    const PATH_VIEW = 'admin.productSizes.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ProductSize::query()->latest('id')->paginate(5);
        if (Auth::user()->role_id === 1) {
            return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role_id === 1) {
            return view(self::PATH_VIEW . __FUNCTION__);
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ProductSize::query()->create($request->all());
        if (Auth::user()->role_id === 1) {
            return redirect()->route('admin.productSizes.index')->with('success', 'Product Size created successfully!');
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->role_id === 1) {
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = ProductSize::query()->findOrFail($id);
        if (Auth::user()->role_id === 1) {
            return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = ProductSize::query()->findOrFail($id);

        $model->update($request->all());
        if (Auth::user()->role_id === 1) {
            return redirect()->route('admin.productSizes.index')->with('success', 'Product Size updated successfully!');
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $product = ProductSize::findOrFail($id);
        $product->update([
            'status' => $request->status
        ]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = ProductSize::query()->findOrFail($id);
        if (Auth::user()->role_id === 1) {
            $model->delete();

            return back()->with('success', 'Product Size deleted successfully!');
        } else {
            return back()->with('error', 'Access denied!');
        };
    }
}
