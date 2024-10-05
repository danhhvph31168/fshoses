<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthenController;
use App\Http\Controllers\Auth\EmployeeController;
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
Route::get('login', [AuthenController::class, 'showFormLogin']);
Route::post('login', [AuthenController::class, 'handleLogin']);

Route::get('register', [AuthenController::class, 'showFormRegister']);
Route::post('register', [AuthenController::class, 'handleRegister']);

Route::post('logout', [AuthenController::class, 'logout']);


Route::middleware('auth')->group(function () {
    Route::get('user', [UserController::class, 'dashboard'])
        ->middleware(IsUser::class);

    Route::get('admin', [AdminController::class, 'admin'])

        ->middleware(IsAdmin::class);

    Route::get('employee', [EmployeeController::class, 'employee'])
        ->middleware(IsEmployee::class);

});

