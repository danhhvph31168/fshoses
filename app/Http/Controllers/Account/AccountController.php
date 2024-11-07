<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class AccountController extends Controller
{
    public function showFormUpdateProfile($id)
    {
        $user = Auth::user();
        if ($user->id != $id) {
            return view('page-error.404');
        }
        return view('profiles.formProfile', compact('user'));
    }

    public function handleUpdateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $linkAvatar = $user->avatar; // Giữ lại ảnh cũ

        if ($request->hasFile('avatar')) {  // Kiểm tra xem request có gửi ảnh mới lên không
            if ($user->avatar) {
                Storage::delete($user->avatar); // Nếu có avatar cũ thì xóa file cũ trong storage
            }

            $image = $request->file('avatar'); // Lấy file ảnh mới từ request
            $newNameImage = time() . '.' . $image->getClientOriginalExtension(); // Tạo tên mới cho ảnh

            // Lưu ảnh mới vào thư mục storage/app/public/images-profile/
            $linkAvatar = $image->storeAs('public/images-profile', $newNameImage);
            $linkAvatar = Storage::url($linkAvatar);  // Tạo đường dẫn công khai để truy cập file
        }

        // Cập nhật dữ liệu người dùng
        $data = [
            'name' => $request->name,
            'avatar' => $linkAvatar,
            'phone' => $request->phone,
            'address' => $request->address,
            'district' => $request->district,
            'province' => $request->province,
            'zip_code' => $request->zip_code,
        ];

        $user->update($data);

        return redirect()->back()->with('success', 'Account information updated successfully.');
    }

    public function showFormChangePassword()
    {

        return view('profiles.showFormChangePassword');
    }

    public function handleChangePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->old_password, $user->password)) {

            throw ValidationException::withMessages([
                'old_password' => ['The current password is incorrect.'],
            ]);
        }

        // Cập nhật mật khẩu mới
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        // Chuyển hướng hoặc trả về thông báo thành công
        return redirect()->back()->with('message', 'Password changed successfully.');
    }
}
