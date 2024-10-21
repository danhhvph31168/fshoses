<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthenController;
use App\Http\Controllers\Auth\EmployeeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckEmployee;
use App\Http\Middleware\CheckUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::get('register', [AuthenController::class, 'showFormRegister'])->name('showFormRegister');
        Route::post('register', [AuthenController::class, 'handleRegister'])->name('handleRegister');

        Route::get('login', [AuthenController::class, 'showFormLogin'])->name('showFormLogin');
        Route::post('login', [AuthenController::class, 'handleLogin'])->name('handleLogin');

        Route::post('logout', [AuthenController::class, 'logout'])->name('logout');
    });

Route::get('clickToForgot', [AuthenController::class, 'clickToForgot'])->name('clickToForgot');
Route::post('handleSendMailForgot', [AuthenController::class, 'handleSendMailForgot'])->name('handleSendMailForgot');
Route::get('clickInEmailForgot/{id}/{token}', [AuthenController::class, 'clickInEmailForgot'])->name('clickInEmailForgot');
Route::post('handleForgotPass/{id}/{token}', [AuthenController::class, 'handleForgotPass'])->name('handleForgotPass');

Route::middleware('profile')->group(function () {
    Route::get('profile/{id}', [ProfileController::class, 'showFormUpdateProfile'])->name('showFormUpdateProfile');
    Route::put('profile/{id}/update', [ProfileController::class, 'handleUpdateProfile'])->name('handleUpdateProfile');
});


Route::get('user', [UserController::class, 'dashboard'])
    ->name('user.dashboard')
    ->middleware(['auth', CheckUser::class]);


Route::get('employee', [EmployeeController::class, 'dashboard'])
    ->name('employee.dashboard')
    ->middleware(['auth', CheckEmployee::class]);

Route::get('admin', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware(['auth', CheckAdmin::class]);

