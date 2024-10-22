<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\HandleForgotPassRequest;
use App\Http\Requests\API\HandleLoginRequest;
use App\Http\Requests\API\HandleRegisterRequest;
use App\Http\Requests\API\HandleSendMailForgotRequest;
use App\Models\User;
use Hash;
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


        return redirect()->route('user.dashboard');

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
            $user = Auth::user();
            // Tạo token
            $token = $user->createToken('auth_token')->plainTextToken;
            // Dữ liệu người dùng trả về cho frontend
            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role->name,
            ];
            // dd($userData);
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
                // return response()->json([
                //     'success' => true,
                //     'message' => 'Đăng nhập thành công.',
                //     'role' => 'admin',
                //     'account' => $userData,
                //     'token' => $token,
                //     'redirect' => route('admin.dashboard')
                // ], 200);
            }
            if ($user->isEmployee()) {
                return redirect()->route('employee.dashboard');
                // return response()->json([
                //     'success' => true,
                //     'message' => 'Đăng nhập thành công.',
                //     'role' => 'employee',
                //     'account' => $userData,
                //     'token' => $token,
                //     'redirect' => route('employee.dashboard')
                // ], 200);
            }
            if ($user->isUser()) {
                return redirect()->route('user.dashboard');
                // return response()->json([
                //     'success' => true,
                //     'message' => 'Đăng nhập thành công.',
                //     'role' => 'user',
                //     'account' => $userData,
                //     'token' => $token,
                //     'redirect' => route('user.dashboard')
                // ], 200);
            }
            return redirect()->route('user.dashboard');
            // return response()->json([
            //     'success' => true,
            //     'message' => 'Đăng nhập thành công.',
            //     'token' => $token,
            //     'redirect' => route('user.dashboard')
            // ]);
        }
    }

    public function logout()
    {
        // Lấy người dùng hiện tại (nếu đã đăng nhập)
        $user = Auth::user();

        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn chưa đăng nhập!',
            ], 401); // Trả về mã lỗi 401 (Unauthorized)
        }
        // Xóa token hiện tại
        $user->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Đăng xuất thành công!',
        ], 200);
    }


    public function clickToForgot()
    {
        // Hiển thị trang quên mật khẩu
        return response()->json([
            'email' => '',
        ]);
    }
    public function handleSendMailForgot(HandleSendMailForgotRequest $request)
    {

        // Tìm kiếm người dùng qua email
        $user = User::where('email', $request->email)->first();

        // Kiểm tra xem email có tồn tại trên db hay không
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email không tồn tại trong hệ thống.'
            ], 404);
        }

        // Tạo token đặt lại mật khẩu
        $token = Password::createToken($user);

        // Gửi email đến email tài khoản chứa liên kết đặt lại mật khẩu
        Mail::send('auth.mail', ['user' => $user, 'token' => $token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Liên kết đặt lại mật khẩu của bạn');
        });
        return response()->json([
            'success' => true,
            'message' => 'Liên kết đặt lại mật khẩu đã được gửi đến email của bạn.',
            'token' => $token,

        ]);
    }
    public function clickInEmailForgot($id, $token)
    {
        // Tìm kiếm người dùng qua ID
        $user = User::where('id', $id)->first();

        // Hiển thị form đặt lại mật khẩu
        return response()->json([
            'success' => true,
            'message' => 'Liên kết hợp lệ.',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);
    }
    public function handleForgotPass(HandleForgotPassRequest $request, $id, $token)
    {

        // Tìm người dùng
        $user = User::where('id', $id)->first();

        // Kiểm tra token có hợp lệ không
        if (!Password::tokenExists($user, $token)) {
            return response()->json([
                'success' => false,
                'message' => 'Liên kết đặt lại mật khẩu không hợp lệ.'
            ], 400);
        }

        // Cập nhật mật khẩu mới
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Xóa token sau khi mật khẩu được cập nhật
        Password::deleteToken($user);

        return response()->json([
            'success' => true,
            'message' => 'Mật khẩu của bạn đã được đặt lại thành công.'
        ]);
    }

}