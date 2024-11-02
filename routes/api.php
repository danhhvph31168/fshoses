<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Admin\CouponController;
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


Route::prefix('ratings')->group(function () {
    Route::get('/', [RatingController::class, 'index']);
    Route::post('/store', [RatingController::class, 'store']);
    Route::get('/{id}/average-rating', [RatingController::class, 'calculateAverageRating']);
});


Route::prefix('coupons')->group(function () {
    Route::get('/', [CouponController::class, 'index']);
    Route::post('/store', [CouponController::class, 'store']);
    Route::get('/{id}/edit', [CouponController::class, 'edit']);
    Route::put('/{id}/update', [CouponController::class, 'update']);
    Route::delete('/{id}', [CouponController::class, 'destroy']);
});

