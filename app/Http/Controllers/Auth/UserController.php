<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
        // return response()->json([
        //     'status' => "Success",
        //     "message" => "Đây là trang người dùng"
        // ], 201);
    }
}
