<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin(){
        // Lấy thông tin người dùng hiện tại
        $admin = Auth::user();

        // Trả về dữ liệu JSON cho frontend
       return response()->json([
           'message' => 'Trang dashboard của admin!',
           'data' => $admin
       ]);
   }
}
