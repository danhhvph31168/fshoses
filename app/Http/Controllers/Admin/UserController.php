<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const PATH_VIEW = 'admin.users.';

    const PATH_UPLOAD = 'users';
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth::user();
        $data = User::query()->with('role')->latest('id')->paginate(5);

        if ($user->role_id === 1) {
            return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
        } else {
            echo "Access denied!";
            return back();
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $role = Role::query()->pluck('name', 'id')->all();

        // dd($role);
        if ($user->role_id === 1) {
            return view(self::PATH_VIEW . __FUNCTION__, compact('role'));
        } else {
            echo "Access denied!";
            return back();
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $request->except('avatar');

        if ($user->role_id === 1) {

            if ($request->hasFile('avatar')) {
                $data['avatar'] = Storage::put(self::PATH_UPLOAD, $request->file('avatar'));
            } else {
                $data['avatar'] = "users/avatar-mac-dinh.jpg";
            }
            // dd($data);
            User::query()->create($data);

            return redirect()->route('admin.users.index')->with('success', 'Account created successfully!');
        } else {
            echo "Access denied!";
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $data = User::query()->findOrFail($id);

        // dd($data);

        if ($user->role_id === 1) {
            return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
        } else {
            echo "Access denied!";
        };
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $model = User::query()->findOrFail($id);
        // dd($data);

        $role = Role::query()->pluck('name', 'id')->all();
        if ($user->role_id === 1) {
            return view(self::PATH_VIEW . __FUNCTION__, compact('model', 'role'));
        } else {
            echo "Access denied!";
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $model = User::query()->findOrFail($id);

        // dd($model->status);

        if ($user->role_id === 1) {

            $data = $request->except('avatar');

            if ($request->hasFile('avatar')) {
                $data['avatar'] = Storage::put(self::PATH_UPLOAD, $request->file('avatar'));
            }

            $currentAvatar = $model->avatar;

            $model->update($data);

            if ($request->hasFile('cover') && $currentAvatar && Storage::exists($currentAvatar)) {
                Storage::delete($currentAvatar);
            }

            return redirect()->route('admin.users.index')->with('success', 'Account updated successfully!');
        } else {
            echo "Access denied!";
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $model = User::query()->findOrFail($id);
        if ($user->role_id === 1) {
            $model->delete();

            if ($model->avatar && Storage::exists($model->avatar)) {
                Storage::delete($model->avatar);
            }

            return back()->with('success', 'Account deleted successfully');
        } else {
            echo "Bạn không có quyền truy cập!";
            return back();
        };
    }
}
