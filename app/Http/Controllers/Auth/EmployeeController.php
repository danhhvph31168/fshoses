<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function employee(){
        // Lấy thông tin người dùng hiện tại
        $employee = Auth::user();

        // Trả về dữ liệu JSON cho frontend
       return response()->json([
           'message' => 'Trang dashboard của nhân viên!',
           'data' => $employee
       ]);
   }
}
