<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Http\Requests\API\ChangePasswordRequest;
use App\Http\Requests\API\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class AccountController extends Controller
{
    public function showFormUpdateProfile()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'message' => 'Người dùng chưa được xác thực'
            ], 401);
        }

        // return view('profile.formProfile', compact('user'));
        return response()->json([
            'status' => 'Success',
            'account' => $user,
        ], 200);
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
            'email' => $request->email,
            'avatar' => $linkAvatar,
            'phone' => $request->phone,
            'address' => $request->address,
            'balance' => $request->balance,
            'district' => $request->district,
            'province' => $request->province,
            'zip_code' => $request->zip_code,
        ];

        $user->update($data);

        // return redirect()->back()->with('message', 'Cập nhật người dùng thành công.');
        return response()->json([
            'status' => 'Thành công',
            'message' => 'Cập nhật người dùng thành công.',
            'account' => $user, // Trả về thông tin người dùng đã cập nhật
        ], 200);
    }

    public function showFormChangePassword()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Form thay đổi mật khẩu.',
        ], 200);
        // return view('profile.showFormChangePassword');
    }
    public function handleChangePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mật khẩu hiện tại không đúng.'
            ], 422);
            // throw ValidationException::withMessages([
            //     'old_password' => ['Mật khẩu hiện tại không đúng.'],
            // ]);
        }

        // Cập nhật mật khẩu mới
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Thay đổi mật khẩu thành công.'
        ], 200);
        // Chuyển hướng hoặc trả về thông báo thành công
        // return redirect()->back()->with('message', 'Thay đổi mật khẩu thành công.');
    }

}
