<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    const PATH_VIEW = 'admin.roles.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $data = Role::query()->latest('id')->paginate(10);
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
        if ($user->role_id === 1) {
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
        $user = Auth::user();
        Role::query()->create($request->all());
        if ($user->role_id === 1) {
            return redirect()->route('admin.roles.index')->with('success', 'Role created successfully!');
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
        if ($user->role_id === 1) {
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
        $model = Role::query()->findOrFail($id);
        if ($user->role_id === 1) {
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

        $user = Auth::user();
        $model = Role::query()->findOrFail($id);

        $model->update($request->all());
        if ($user->role_id === 1) {
            return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully!');
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
        $model = Role::query()->findOrFail($id);
        if ($user->role_id === 1) {
            $model->delete();

            return back()->with('success', 'Role deleted successfully!');
        } else {
            return back()->with('error', 'Access denied!');
        };
    }
}
