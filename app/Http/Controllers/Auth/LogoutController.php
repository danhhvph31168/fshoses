<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Request;

class LogoutController extends Controller
{
    public function logout()
    {
        // Lấy người dùng hiện tại
    $user = Auth::user();

    if ($user) {
        // Xóa tất cả các token của người dùng
        $user->tokens()->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Đăng xuất thành công!'
        ]);
    }
    }
}
