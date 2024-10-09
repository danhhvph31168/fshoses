<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showFormLogin()
    {
        // Trả về dữ liệu cho frontend
        return response()->json([
            'status' => 'success',
            'message' => 'Giao diện đăng nhập',
            'data' => [
                'email' => '',
                'password' => '',
            ],
        ]);
    }
    public function handleLogin(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);
        // Dữ liệu xác thực
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt($data)) {
            // Lấy thông tin người dùng hiện tại
            $user = Auth::user();

            // Kiểm tra vai trò người dùng
            if ($user->role_id === 0) {
                // Nếu là user
                return response()->json([
                    'status' => 'success',
                    'message' => 'Đăng nhập thành công!',
                    'role' => 0,  // User
                    'data' => $user,  // Trả về thông tin người dùng
                ]);
            } elseif ($user->role_id === 1) {
                // Nếu là employee
                return response()->json([
                    'status' => 'success',
                    'message' => 'Đăng nhập thành công!',
                    'role' => 1,    //  Employee
                    'data' => $user,      // Trả về thông tin người dùng
                ]);
            } elseif ($user->role_id === 2) {
                // Nếu là admin
                return response()->json([
                    'status' => 'success',
                    'message' => 'Đăng nhập thành công!',
                    'role' => 2, // Admin
                    'data' => $user,    // Trả về thông tin người dùng
                ]);
            }
        }

        // Nếu thông tin đăng nhập không đúng
        return response()->json([
            'status' => 'error',
            'message' => 'Email hoặc mật khẩu không đúng'
        ], 401); // Mã lỗi 401 cho yêu cầu không hợp lệ

    }
}
