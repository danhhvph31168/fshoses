<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthenController;
use App\Http\Controllers\Auth\EmployeeController;
use App\Http\Controllers\Auth\ForgotPassController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsEmployee;
use App\Http\Middleware\IsUser;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')
->name('auth.')
->group(function () {
    Route::get('register', [RegisterController::class, 'showFormRegister'])->name('showFormRegister');
    Route::post('register', [RegisterController::class, 'handleRegister'])->name('handleRegister');

    Route::get('login', [LoginController::class, 'showFormLogin'])->name('showFormLogin');
    Route::post('login', [LoginController::class, 'handleLogin'])->name('handleLogin');

    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

    Route::get('forgotPass', [ForgotPassController::class, 'showForgotPassForm'])->name('showForgotPassForm');
    Route::post('forgotPass', [ForgotPassController::class, 'handleForgotPass'])->name('handleForgotPass');
});
