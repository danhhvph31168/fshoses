<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        // Chuyển hướng người dùng đến Google và yêu cầu chọn tài khoản mỗi lần
        return Socialite::driver('google')
            ->scopes(['profile', 'email'])
            ->with(['prompt' => 'select_account'])  // Yêu cầu người dùng chọn tài khoản mỗi lần
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Lấy thông tin người dùng từ Google
            $googleUser = Socialite::driver('google')->user();
            // Tìm người dùng trong cơ sở dữ liệu hoặc tạo mới
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt('123456dummy'), // Tạo mật khẩu ngẫu nhiên
                ]
            );
         
            // Đăng nhập người dùng
            Auth::login($user);

            return redirect()->route('home'); // Chuyển hướng sau khi đăng nhập thành công
        } catch (\Exception $e) {
            return redirect()->route('auth.showFormLogin')->with(['error' => 'Google login failed!']);
        }
    }
}
