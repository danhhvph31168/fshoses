<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function showFormUpdateProfile()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'message' => 'User not authenticated'
            ], 401);
        }

        return view('profile.formProfile', compact('user'));
        // return response()->json([
        //     'status' => 'Success',
        //     'account' => $data,
        // ], 200);
    }
    public function handleUpdateProfile(){
        $user = Auth::user();
    }
}
