<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\HandleForgotPassRequest;
use App\Http\Requests\Auth\HandleLoginRequest;
use App\Http\Requests\Auth\HandleRegisterRequest;
use App\Http\Requests\Auth\HandleSendMailForgotRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Password;


class AuthenController extends Controller
{
    public function showFormRegister()
    {
        return view('auth.register');
    }
    public function handleRegister(HandleRegisterRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Thêm mới User vào cơ sở dữ liệu
        $user = User::query()->create($data);

        Auth::login($user);

        return redirect()->route('home');
    }
    public function showFormLogin()
    {
        // Hiển thị form đăng nhập
        return view('auth.login');
    }
    public function handleLogin(HandleLoginRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        // Tạo remember_token khi người dùng tích vào ô checkbox
        $remember = $request->has('remember');

        if (Auth::attempt($data, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended()->with('success', 'Login successfully');
        } else {
            // If authentication fails
            return redirect()->back()->with(['error' => 'The login credentials are invalid. Please try again.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logout successfully');;
    }


    public function clickToForgot()
    {
        return view('auth.forgot');
    }
    public function handleSendMailForgot(HandleSendMailForgotRequest $request)
    {
        // Tìm kiếm người dùng qua email
        $user = User::where('email', $request->email)->first();

        // Tạo token đặt lại mật khẩu
        $token = Password::createToken($user);

        // Gửi email đến email tài khoản chứa liên kết đặt lại mật khẩu
        Mail::send('auth.mail', ['user' => $user, 'token' => $token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Liên kết đặt lại mật khẩu của bạn');
        });
        
        return redirect()->back()->with('success', 'A password reset link has been sent to your email.');
    }
    public function clickInEmailForgot($id, $token)
    {
        // Tìm kiếm người dùng qua ID
        $user = User::find($id);

        // Kiểm tra user có tồn tại hay token có hợp lệ không
        if (!$user || !Password::tokenExists($user, $token)) {
            return redirect()->route('auth.showFormLogin')
            ->with('error', 'The link is invalid or has expired.');
        }

        return view('auth.reset', ['user' => $user, 'token' => $token]);
    }
    public function handleForgotPass(HandleForgotPassRequest $request, $id, $token)
    {
        // Tìm người dùng
        $user = User::find($id);

        // Kiểm tra token có hợp lệ không
        if (!Password::tokenExists($user, $token)) {
            return redirect()->route('auth.showFormLogin')
            ->with('error', 'The password reset link is invalid.');
        }

        // Cập nhật mật khẩu mới
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Xóa token sau khi mật khẩu được cập nhật
        Password::deleteToken($user);

        return redirect()->route('messageSuccessReset')
        ->with('success', 'Your password has been successfully reset. Please log in again.');
    }
}
