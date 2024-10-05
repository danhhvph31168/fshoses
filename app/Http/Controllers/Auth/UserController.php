<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard(){
         // Lấy thông tin người dùng hiện tại
         $user = Auth::user();

         // Trả về dữ liệu JSON cho frontend
        return response()->json([
            'message' => 'Trang dashboard của người dùng!',
            'data' => $user
        ]);
    }
}
