<?php

namespace App\Http\Controllers\Client;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\API\UpdateProfileRequest;
use App\Http\Requests\API\ChangePasswordRequest;


class AccountController extends Controller
{
    const PATH_UPLOAD = 'users.';
    public function showFormUpdateProfile()
    {
        $user = Auth::user();

        return view('client.profiles.form-update-profile', compact('user'));
    }

    public function handleUpdateProfile(UpdateProfileRequest $request, string $id)
    {
        dd($request->all());
        
        $user = User::query()->findOrFail(id: $id);

        if (Auth::user()->role_id == 1) {

            $data = $request->except('avatar');

            if ($request->hasFile('avatar')) {
                $data['avatar'] = Storage::put(self::PATH_UPLOAD, $request->file('avatar'));
            }

            $currentAvatar = $user->avatar;

            $data = [
                'name' => $request->name,
                'avatar' => $request->avatar,
                'phone' => $request->phone,
                'address' => $request->address,
                'district' => $request->district,
                'province' => $request->province,
                'ward' => $request->ward,
                'zip_code' => $request->zip_code,
            ];

            $user->update($data);

            if ($request->hasFile('cover')  && $currentAvatar && Storage::exists($currentAvatar)) {
                Storage::delete($currentAvatar);
            }

            return redirect()->route('showFormUpdateProfile')->with('success', 'Account updated successfully!');
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    public function showFormChangePassword()
    {
        return view('client.profiles.showFormChangePassword');
    }
    public function handleChangePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password_confirmation)) {
            throw ValidationException::withMessages([
                'old_password' => ['Mật khẩu hiện tại không đúng.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('message', 'Thay đổi mật khẩu thành công.');
    }
}
