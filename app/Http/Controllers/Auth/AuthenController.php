<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\HandleForgotPassRequest;
use App\Http\Requests\API\HandleLoginRequest;
use App\Http\Requests\API\HandleRegisterRequest;
use App\Http\Requests\API\HandleSendMailForgotRequest;
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
        // Hiển thị giao diện form đăng ký
        // return response()->json([
        //     'name' => '',
        //     'email' => '',
        //     'password' => '',
        //     'confirm_password' => ''
        // ]);
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
        // dd($user);

        return redirect()->route('home.dashboard');

        // Trả về dữ liệu JSON cho frontend
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Đăng ký thành công!',
        //     'user' => $user,
        // ],201);
    }
    public function showFormLogin()
    {
        // Hiển thị form đăng nhập
        return view('auth.login');
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Form đăng nhập.',
        //     'email' => '',
        //     'password' => '',
        // ], 200);
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
            return redirect()->route('home.dashboard')->with('message', 'Login successful');
        } else {
            // If authentication fails
            return redirect()->back()->with(['error' => 'Thông tin đăng nhập không hợp lệ, vui lòng thử lại.']);
        }
    }

    public function logout(Request $request)
    {
        // Lấy người dùng hiện tại (nếu đã đăng nhập)
        // $user = Auth::user();

        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        // if (!$user) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Bạn chưa đăng nhập!',
        //     ], 401); // Trả về mã lỗi 401 (Unauthorized)
        // }
        // Xóa token hiện tại
        // $user->currentAccessToken()->delete();
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.showFormLogin');
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Đăng xuất thành công!',
        // ], 200);
    }


    public function clickToForgot()
    {
        // Hiển thị trang quên mật khẩu
        return view('auth.forgot');
        // return response()->json([
        //     'email' => '',
        // ]);
    }
    public function handleSendMailForgot(HandleSendMailForgotRequest $request)
    {

        // Tìm kiếm người dùng qua email
        $user = User::where('email', $request->email)->first();

        // Kiểm tra xem email có tồn tại trên db hay không
        if (!$user) {
            return redirect()->back()->with('error', 'Email không tồn tại trong hệ thống.');
            // return response()->json([
            //     'success' => false,
            //     'message' => 'Email không tồn tại trong hệ thống.'
            // ], 404);
        }

        // Tạo token đặt lại mật khẩu
        $token = Password::createToken($user);

        // Gửi email đến email tài khoản chứa liên kết đặt lại mật khẩu
        Mail::send('auth.mail', ['user' => $user, 'token' => $token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Liên kết đặt lại mật khẩu của bạn');
        });
        return redirect()->back()->with('message', 'Liên kết đặt lại mật khẩu đã được gửi đến email của bạn.');
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Liên kết đặt lại mật khẩu đã được gửi đến email của bạn.',
        //     'token' => $token,

        // ]);
    }
    public function clickInEmailForgot($id, $token)
    {
        // Tìm kiếm người dùng qua ID
        $user = User::find($id);
        // Kiểm tra user có tồn tại hay token có hợp lệ không
        if (!$user || !Password::tokenExists($user, $token)) {
            return redirect()->route('auth.showFormLogin')->with('error', 'Liên kết không hợp lệ hoặc đã hết hạn.');
        }
        // Nếu hợp lệ, hiển thị form đặt lại mật khẩu
        return view('auth.reset', ['user' => $user, 'token' => $token]);
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Liên kết hợp lệ.',
        //     'data' => [
        //         'user' => $user,
        //         'token' => $token
        //     ]
        // ]);
    }
    public function handleForgotPass(HandleForgotPassRequest $request, $id, $token)
    {

        // Tìm người dùng
        $user = User::find($id);

        // Kiểm tra token có hợp lệ không
        if (!Password::tokenExists($user, $token)) {
            return redirect()->route('auth.showFormLogin')->with('error', 'Liên kết đặt lại mật khẩu không hợp lệ.');
            // return response()->json([
            //     'success' => false,
            //     'message' => 'Liên kết đặt lại mật khẩu không hợp lệ.'
            // ], 400);
        }

        // Cập nhật mật khẩu mới
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Xóa token sau khi mật khẩu được cập nhật
        Password::deleteToken($user);
        return redirect()->route('auth.showFormLogin')->with('message', 'Mật khẩu của bạn đã được đặt lại thành công. Vui lòng đăng nhập lại.');
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Mật khẩu của bạn đã được đặt lại thành công.'
        // ]);
    }

}