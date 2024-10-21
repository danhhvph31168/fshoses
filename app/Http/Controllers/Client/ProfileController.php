<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showFormUpdateProfile()
    {
        $data = Auth::user();
        return view('profile.formProfile',compact('data'));
    }
    public function handleUpdateProfile(Request $request)
    {

    }
}
