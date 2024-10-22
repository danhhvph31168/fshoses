<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function dashboard(){
        return view('employee.dashboard');
        // return response()->json([
        //     'status' => "Success",
        //     "message" => "Đây là trang nhân viên"
        // ],201);
    }
}
