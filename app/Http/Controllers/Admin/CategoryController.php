<?php

namespace App\Http\Controllers\Admin;


use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    const PATH_VIEW = 'admin.categories.';
    const PATH_UPLOAD = 'categories';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $data = Category::query()->latest('id')->paginate(10);
        if ($user->role_id === 1) {
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
        $user = Auth::user();
        $parentCategories = Category::query()->get();

        if ($user->role_id === 1) {
            return view(self::PATH_VIEW . __FUNCTION__, compact('parentCategories'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $user = Auth::user();
        Category::query()->create($request->all());
        if ($user->role_id === 1) {
            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');;
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $model = Category::query()->findOrFail($id);
        if ($user->role_id === 1) {
            return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $model = Category::query()->findOrFail($id);

        $parentCategories = Category::query()->get();
        if ($user->role_id === 1) {
            return view(self::PATH_VIEW . __FUNCTION__, compact('model', 'parentCategories'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, string $id)
    {
        $user = Auth::user();
        $model = Category::query()->findOrFail($id);

        $data = $request->except('image');

        if ($request->hasFile('image')) {

            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        $currentImage = $model->image;

        $model->update($data);

        if ($request->hasFile('image') && $currentImage && Storage::exists($currentImage)) {

            Storage::delete($currentImage);
        }

        if ($user->role_id === 1) {
            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $model = Category::query()->findOrFail($id);
        if ($user->role_id === 1) {
            $model->delete();

            if ($model->image && Storage::exists($model->image)) {

                Storage::delete($model->image);
            }

            return back()->with('success', 'Category deleted successfully!');
        } else {
            return back()->with('error', 'Access denied!');
        };
    }
}
