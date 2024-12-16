<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    const PATH_VIEW = 'admin.brands.';

    const PATH_UPLOAD = 'brands';

    public function index()
    {
        if (Auth::user()->role_id == 1) {

            $data = Brand::query()->latest('id')->paginate(5);

            return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
        } else {

            return back()->with('error', 'Access denied!');
        }
    }

    public function create()
    {
        if (Auth::user()->role_id == 1) {

            return view(self::PATH_VIEW . __FUNCTION__);
        } else {

            return back()->with('error', 'Access denied!');
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->role_id == 1) {

            $data = $request->except('image');

            if ($request->hasFile('image')) {

                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }

            Brand::query()->create($data);

            return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully!');
        } else {

            return back()->with('error', 'Access denied!');
        }
    }

    public function edit(string $id)
    {
        if (Auth::user()->role_id == 1) {

            $model = Brand::query()->findOrFail($id);

            return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
        } else {

            return back()->with('error', 'Access denied!');
        }
    }

    public function update(Request $request, string $id)
    {
        if (Auth::user()->role_id == 1) {

            $model = Brand::query()->findOrFail($id);

            $data = $request->except('image');

            if ($request->hasFile('image')) {

                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }

            $currentImage = $model->image;

            $model->update($data);

            if ($request->hasFile('image') && $currentImage && Storage::exists($currentImage)) {

                Storage::delete($currentImage);
            }

            return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully!');
        } else {

            return back()->with('error', 'Access denied!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->role_id == 1) {

            $model = Brand::query()->findOrFail($id);

            $model->delete();

            if ($model->image && Storage::exists($model->image)) {

                Storage::delete($model->image);
            }

            return back()->with('success', 'Brand deleted successfully');
        } else {

            return back()->with('error', 'Access denied!');
        };
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update([
            'status' => $request->status
        ]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
