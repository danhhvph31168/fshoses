<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showFormRegister()
    {
        // Trả về dữ liệu cho frontend
        return response()->json([
            'status' => 'success',
            'message' => 'Giao diện đăng ký',
            'data' => [
                'name' => '',
                'email' => '',
                'password' => '',
                'password_confirmation' => '',
                'phone' => '',
                'address' => '',
                'balance' => '',        // Số dư tài khoản
                'district' => '',       // Quận / Huyện
                'province' => '',       // Tỉnh / TP
                'zip_code' => '',
            ],
        ]);
    }

    public function handleRegister(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',  // Có thể để trống, kiểu chuỗi, tối đa 15 ký tự
            'address' => 'nullable|string|max:255',  // Có thể để trống, kiểu chuỗi, tối đa 255 ký tự
            'balance' => 'nullable|numeric|min:0',  // Có thể để trống, kiểu số, không âm
            'district' => 'nullable|string|max:255',  // Có thể để trống, kiểu chuỗi, tối đa 255 ký tự
            'province' => 'nullable|string|max:255',  // Có thể để trống, kiểu chuỗi, tối đa 255 ký tự
            'zip_code' => 'nullable|string|max:10',  // Có thể để trống, kiểu chuỗi, tối đa 10 ký tự
        ]);
         // Kiểm tra xem email đã tồn tại hay chưa
    $check = User::where('email', $request->email)->exists();
    
    if (!$check) {
        // Kiểm tra xem mật khẩu và xác nhận mật khẩu có trùng khớp không
        if ($request->password === $request->confirmPassword) {
            // Tạo mảng dữ liệu để lưu vào cơ sở dữ liệu
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' =>$request->password,
                'phone' =>$request->phone,
                'address' =>$request->address,
                'balance' =>$request->balance,
                'district' =>$request->district,
                'province' =>$request->province,
                'zip_code' =>$request->zip_code,
            ];
            
            // Tạo người dùng mới
            User::create($data);
            
            // Trả về phản hồi thành công
            return response()->json([
                'status' => 'success',
                'message' => 'Đăng ký thành công!',
            ], 201); // Mã lỗi 201 cho yêu cầu thành công và tạo mới
        }

        // Nếu mật khẩu không khớp, trả về lỗi
        return response()->json([
            'status' => 'error',
            'message' => 'Mật khẩu xác nhận không khớp.',
        ], 422); // Mã lỗi 422 cho yêu cầu không hợp lệ
    } else {
        // Nếu email đã tồn tại, trả về lỗi
        return response()->json([
            'status' => 'error',
            'message' => 'Email đã được sử dụng.',
        ], 409); // Mã lỗi 409 cho xung đột
    }
    }
}
