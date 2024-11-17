<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthenController;
use App\Http\Controllers\Auth\EmployeeController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckEmployee;
use App\Http\Middleware\CheckUser;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



