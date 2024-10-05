<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenController extends Controller
{
    public function showFormLogin()
    {
        return response()->json(['message' => 'Hiển thị form đăng nhập'], 200);
    }
    public function handleLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();

            /**
             * @var User
             */
            $user = Auth::user();

            if ($user->isAdmin()) {
                return response()->json([
                    'message' => 'Đăng nhập thành công với quyền admin!',
                    'user' => $user,
                ], 200);
            }

            if ($user->isEmployee()) {
                return response()->json([
                    'message' => 'Đăng nhập thành công với quyền nhân viên!',
                    'user' => $user,
                ], 200);
            }

            return response()->json([
                'message' => 'Đăng nhập thành công!',
                'user' => $user,
            ], 200);
        }

        // Nếu thông tin không chính xác, trả về lỗi
        return response()->json(['message' => 'Đăng nhập thất bại!'], 401);
    }
    public function showFormRegister()
    {
        return response()->json(['message' => 'Hiển thị form đăng ký'], 200);
    }
    public function handleRegister(Request $request)
    {
        // Validate nằm trong đường dẫn : App\Http\Requests\AuthenRequest.php

        // Thêm mới account
        $account = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $request->role_id,
            'phone' => $request->phone,
            'address' => $request->address,
            'balance' => $request->balance,
            'district' => $request->district,
            'province' => $request->province,
            'zip_code' => $request->zip_code,
        ];
        $newAccount = User::create($account);
        // Auth::login($newAccount); //Tự động Đăng nhập người dùng mới sau khi tạo xong tài khoản
        // $request->session()->regenerate(); // Tái sinh session để tránh tấn công session fixation
        return response()->json([
            'data' => $newAccount,
            'message' => "Tạo tài khoản thành công!"
        ], 201);

    }
    public function logout()
    {
        Auth::logout();
        // request()->session()->invalidate();
        // request()->session()->regenerateToken();
        return response()->json([
            'message' => 'Đăng xuất thành công!',
        ], 200);
    }
}
