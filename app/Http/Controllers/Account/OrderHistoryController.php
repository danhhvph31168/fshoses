<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function getListOrderHistory()
    {
        $user = Auth::user();
        $orders = $user->orders;
        return view("client.orders.list-order",compact("orders"));
    }
}
