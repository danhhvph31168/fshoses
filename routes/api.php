<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthenController;
use App\Http\Controllers\Auth\EmployeeController;
use App\Http\Controllers\Auth\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

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


Route::get('user', [UserController::class, 'dashboard'])
    ->name('user.dashboard')
    ->middleware(['auth', CheckUser::class]);


Route::get('employee', [EmployeeController::class, 'dashboard'])
    ->name('employee.dashboard')
    ->middleware(['auth', CheckEmployee::class]);

Route::get('admin', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware(['auth', CheckAdmin::class]);