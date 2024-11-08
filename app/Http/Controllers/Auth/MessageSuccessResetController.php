<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageSuccessResetController extends Controller
{
    public function messageSuccessReset(){
        return view("auth.message-success-reset");
    }
}
