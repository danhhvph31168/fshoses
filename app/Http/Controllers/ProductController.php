<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home()
    {
        return view('welcome'); // Trả về view 'welcome'
    }
}
