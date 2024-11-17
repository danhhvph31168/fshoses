<?php

namespace App\Http\Controllers\admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    const PATH_VIEW = 'admin.banners.';

    const PATH_UPLOAD = 'banners';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role_id == 1) {

            $data = Banner::query()->latest('id')->paginate(5);

            return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
        } else {
            return back()->with('error', 'Access denied!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role_id == 1) {

            return view(self::PATH_VIEW . __FUNCTION__);
        } else {

            return back()->with('error', 'Access denied!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role_id == 1) {

            $data = $request->except('image');

            if ($request->hasFile('image')) {

                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }

            Banner::query()->create($data);

            return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully!');
        } else {

            return back()->with('error', 'Access denied!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->role_id == 1) {

            $model = Banner::query()->findOrFail($id);

            return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
        } else {

            return back()->with('error', 'Access denied!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->role_id == 1) {

            $model = Banner::query()->findOrFail($id);

            $data = $request->except('image');

            if ($request->hasFile('image')) {

                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }

            $currentImage = $model->image;

            $model->update($data);

            if ($request->hasFile('image') && $currentImage && Storage::exists($currentImage)) {

                Storage::delete($currentImage);
            }

            return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully!');
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

            $model = Banner::query()->findOrFail($id);

            $model->delete();

            if ($model->image && Storage::exists($model->image)) {

                Storage::delete($model->image);
            }

            return back()->with('success', 'Banner deleted successfully');
        } else {

            return back()->with('error', 'Access denied!');
        };
    }
}
