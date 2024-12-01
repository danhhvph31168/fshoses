<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
        $data = User::query()->with('role')->latest('id')->paginate(5);
        if ($key = request()->key) {
            $data = User::query()->with('role')->latest('id')
                ->where('name', 'like', '%' . $key . '%')
                ->orWhere('email', 'like', '%' . $key . '%')
                ->orWhere('phone', 'like', '%' . $key . '%')
                ->orWhere('status', 'like', '%' . $key . '%')
                ->paginate(5);
        }

        $user = Auth::user();

        if ($user->role_id === 1) {
            return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {

        $role = Role::query()->pluck('name', 'id')->all();

        if (Auth::user()->role_id == 1) {
            return view(self::PATH_VIEW . __FUNCTION__, compact('role', 'user'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        if (Auth::user()->role_id == 1) {

            $data = $request->except('avatar');

            if ($request->hasFile('avatar')) {
                $data['avatar'] = Storage::put(self::PATH_UPLOAD, $request->file('avatar'));
            } else {
                $data['avatar'] = "users/avatar-mac-dinh.jpg";
            }

            User::query()->create($data);

            return redirect()->route('admin.users.index')->with('success', 'Account created successfully!');
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
        $data = User::query()->findOrFail($id);

        // dd( $data);

        if ($user->role_id === 1) {

            return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $model = User::query()->findOrFail($id);

        $role = Role::query()->pluck('name', 'id')->all();

        if (Auth::user()->role_id == 1) {
            return view(self::PATH_VIEW . __FUNCTION__, compact('model', 'role'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        // dd($request->all());
        $user = Auth::user();

        $model = User::query()->findOrFail($id);

        if ($user->role_id == 1) {

            if ($model->email == $request->email) {

                $data['email'] = $model->email;

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
                return back()->with('error', 'The email has already been taken!');
            }
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    public function destroy(string $id)
    {
        $user = Auth::user();
        $model = User::query()->findOrFail($id);
        if ($user->role_id == 1) {
            $model->delete();

            if ($model->avatar && Storage::exists($model->avatar)) {
                Storage::delete($model->avatar);
            }

            return back()->with('success', 'Account deleted successfully');
        } else {
            return back()->with('error', 'Access denied!');
        };
    }
}
