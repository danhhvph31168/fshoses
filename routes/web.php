<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\Coupon\CouponController;
use App\Http\Controllers\Client\Rating\RatingController;
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

Route::post('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('cart.applyCoupon');

