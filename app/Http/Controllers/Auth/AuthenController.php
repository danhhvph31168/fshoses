<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
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
    public function handleRegister(Request $request)
    {
        // Validate dữ liệu nhập vào form đăng ký
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            // Ghi đè lại lỗi bằng tiếng việt
            'name.required' => 'Tên là bắt buộc.',
            'name.string' => 'Tên phải là chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá :max ký tự.',

            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',

            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => 0
        ];
        // Thêm mới User vào cơ sở dữ liệu
        $user = User::query()->create($data);

        // Sau khi đăng kí thì tự động đăng nhập
        Auth::login($user);
        //  Tạo 1 session mới cho người dùng giúp bảo mật 
        $request->session()->regenerate();
        // Trả về dữ liệu JSON cho frontend

        return redirect()->route('user.dashboard');
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Đăng ký thành công!',
        //     'user' => $user,
        // ]);
    }
    public function showFormLogin()
    {
        // Hiển thị form đăng nhập
        return view('auth.login');
        // return response()->json([
        //     'email' => '',
        //     'password' => '',
        // ]);
    }
    public function handleLogin(Request $request)
    {
        // Validate dữ liệu
        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ], [ // Ghi đè lại lỗi bằng tiếng việt
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.exists' => 'Email không tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ]);
        // Tạo remember_token khi người dùng tích vào ô checkbox
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();

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
                //     'redirect' => route('admin.dashboard')
                // ]);
            }
            if ($user->isEmployee()) {
                return redirect()->route('employee.dashboard');
                // return response()->json([
                //     'success' => true,
                //     'message' => 'Đăng nhập thành công.',
                //     'role' => 'employee',
                //     'account' => $userData,
                //     'redirect' => route('employee.dashboard')
                // ]);
            }
            if ($user->isUser()) {
                return redirect()->route('user.dashboard');
                // return response()->json([
                //     'success' => true,
                //     'message' => 'Đăng nhập thành công.',
                //     'role' => 'user',
                //     'account' => $userData,
                //     'redirect' => route('user.dashboard')
                // ]);
            }
            return redirect()->route('user.dashboard');
            // return response()->json([
            //     'success' => true,
            //     'message' => 'Đăng nhập thành công.',
            //     'redirect' => route('user.dashboard')
            // ]);
        }
    }

    public function logout(Request $request)
    {
        // Đăng xuất người dùng
        Auth::logout();

        // Hủy và xóa hết dữ liệu hiên tại của người dùng đó
        $request->session()->invalidate();

        //  Tạo 1 session mới cho người dùng giúp bảo mật 
        $request->session()->regenerate();


        return redirect()->route('auth.showFormLogin');
        // Trả về cho frontend
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Đăng xuất thành công.'
        // ]);
    }


    public function clickToForgot()
    {
        // Hiển thị trang quên mật khẩu
        return response()->json([
            'email' => '',
        ]);
    }
    public function handleSendMailForgot(Request $request)
    {
        // Validate dữ liệu nhập vào form email
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
        ]);

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
            'message' => 'Liên kết đặt lại mật khẩu đã được gửi đến email của bạn.'
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
    public function handleForgotPass(Request $request, $id, $token)
    {

        // Validate dữ liệu nhập vào form quên mật khẩu
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ], [
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ]);

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