<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class AccountController extends Controller
{
    const PATH_UPLOAD = 'users';
    public function showFormUpdateProfile()
    {
        if (request()->query()) {
            return redirect()->route('showFormUpdateProfile');
        }

        $user = User::findOrFail(Auth::user()->id);

        return view('client.profiles.form-update-profile', compact('user'));
    }

    public function handleUpdateProfile(UpdateProfileRequest $request)
    {
        $user = User::query()->findOrFail(Auth::user()->id);

        $data = $request->except('avatar');

        if ($request->hasFile('avatar')) {
            $data['avatar'] = Storage::put(self::PATH_UPLOAD, $request->file('avatar'));
        }
        $currentAvatar = $user->avatar;

        if ($request->hasFile('cover')  && $currentAvatar && Storage::exists($currentAvatar)) {
            Storage::delete($currentAvatar);
        }

        $data['province'] = (empty($user->province) || is_numeric($user->province)) ? $request->province_text : $user->province;
        $data['district'] = (empty($user->district) || is_numeric($user->district)) ? $request->district_text : $user->district;
        $data['ward'] = (empty($user->ward) || is_numeric($user->ward)) ? $request->ward_text : $user->ward;
        $data['avatar'] = (empty($request->avatar)) ? $user->avatar : $data['avatar'];
   
        $data = [
            'name' => $request->name,
            'avatar' =>  $data['avatar'],
            'phone' => $request->phone,
            'address' => $request->address,
            'district' => $data['district'],
            'province' => $data['province'],
            'ward' => $data['ward'],
            'zip_code' => $request->zip_code,
        ];

        // $data = [
        //             'name'      => $request->name,
        //             'avatar'    => $data['avatar'],
        //             'phone'     => $request->phone,
        //             'address'   => $request->address,
        //             'district'  => $request->district_text,
        //             'province'  => $request->province_text,
        //             'ward'      => $request->ward_text,
        //             'zip_code'  => $request->zip_code,
        //         ];

        dd($data);

        $user->update($data);

        return redirect()->back()->with('success', 'Account information updated successfully.');
    }

    // public function handleUpdateProfile(UpdateProfileRequest $request)
    // {
    //     $user = Auth::user();
    //     $linkAvatar = $user->avatar; // Giữ lại ảnh cũ

    //     if ($request->hasFile('avatar')) {  // Kiểm tra xem request có gửi ảnh mới lên không
    //         if ($user->avatar) {
    //             Storage::delete($user->avatar); // Nếu có avatar cũ thì xóa file cũ trong storage
    //         }

    //         $image = $request->file('avatar'); // Lấy file ảnh mới từ request
    //         $newNameImage = time() . '.' . $image->getClientOriginalExtension(); // Tạo tên mới cho ảnh

    //         // Lưu ảnh mới vào thư mục storage/app/public/images-profile/
    //         $linkAvatar = $image->storeAs('users', $newNameImage);
    //         $linkAvatar = Storage::url($linkAvatar);  // Tạo đường dẫn công khai để truy cập file
    //     }

    //     // Cập nhật dữ liệu người dùng
    //     $data = [
    //         'name'      => $request->name,
    //         'avatar'    => $linkAvatar,
    //         'phone'     => $request->phone,
    //         'address'   => $request->address,
    //         'district'  => $request->district_text,
    //         'province'  => $request->province_text,
    //         'ward'      => $request->ward_text,
    //         'zip_code'  => $request->zip_code,
    //     ];

    //     $user->update($data);

    //     return redirect()->back()->with('success', 'Account information updated successfully.');
    // }


    public function showFormChangePassword()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('client.profiles.form-change-password', compact('user'));
    }

    public function handleChangePassword(ChangePasswordRequest $request)
    {

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            throw ValidationException::withMessages([
                'old_password' => ['The current password is incorrect.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
