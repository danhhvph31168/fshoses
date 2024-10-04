<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthenController extends Controller
{
    public function showFormLogin()
    {
        return response()->json(['message' => 'Hiển thị form đăng nhập'], 200);
    }
    public function handleLogin(AuthenRequest $request)
    {

    }
    public function showFormRegister()
    {
        return response()->json(['message' => 'Hiển thị form đăng ký'], 200);
    }
    public function handleRegister(AuthenRequest $request)
    {
        // Validate nằm trong đường dẫn : App\Http\Requests\AuthenRequest.php

        // Thêm mới account
        $account = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
            // 'role_id' => $request->role_id,
        ]);
        Auth::login($account); /// Tự động Đăng nhập người dùng mới sau khi tạo xong tài khoản
        $request->session()->regenerate(); // Tái sinh session để tránh tấn công session fixation
        return response()->json([
            'data' => $account,
            'message' => "Tạo tài khoản thành công!"
        ], 201);

    }
    public function logout()
    {

    }
}
