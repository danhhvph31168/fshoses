<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\HandleForgotPassRequest;
use App\Http\Requests\Auth\HandleLoginRequest;
use App\Http\Requests\Auth\HandleRegisterRequest;
use App\Http\Requests\Auth\HandleSendMailForgotRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;


class AuthenController extends Controller
{
    public function showFormRegister()
    {
        return view('auth.register');
    }

    public function handleRegister(HandleRegisterRequest $request)
    {
        $checkStatus = User::where('email', $request->email)->where('status', 0)->first();

        if ($checkStatus) {
            $request->validate([
                'name'      => 'required|string|max:255',
                'email'     => 'required|email',
                'password'  => 'required|min:8|confirmed',
            ]);

            $user = User::query()->where('email', $request->email)->update([
                'name'      => $request->name,
                'password'  => bcrypt($request->password),
                'status'    => 1
            ]);

            Auth::login($checkStatus);
        } else {
            $request->validate([
                'name'      => 'required|string|max:255',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'required|min:8|confirmed',
            ]);

            $user = User::query()->create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => $request->password,
                'role_id'   => 1,
            ]);

            Auth::login($user);
        }

        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Welcome, you have successfully registered an account.');
    }
    public function showFormLogin()
    {
        return view('auth.login');
    }

    public function handleLogin(HandleLoginRequest $request)
    {
        $checkStatus = User::where('email', $request->email)->where('status', 0)->first();
        if ($checkStatus) {
            return back()->with('error', 'account does not exist');
        } else {
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
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('client.home')->with('success', 'Logout successfully');
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
        try {
            Mail::send('auth.mail', ['user' => $user, 'token' => $token], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Your password reset link');
            });

            return redirect()->back()->with('success', 'A password reset link has been sent to your email.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'The email could not be sent. Please try again later.');
        }
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
            return redirect()->route('auth.showFormLogin')->with('error', 'The password reset link is invalid.');
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
