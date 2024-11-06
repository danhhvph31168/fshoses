<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\CouponController;

Route::prefix('admin')->as('admin.')
        ->group(function () {
            Route::prefix('coupons')->as('coupons.')->group(function () {
                Route::get('/', [CouponController::class, 'index'])->name('index');
                Route::get('/create', [CouponController::class, 'create'])->name('create');
                Route::post('/store', [CouponController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [CouponController::class, 'edit'])->name('edit');
                Route::put('/{id}', [CouponController::class, 'update'])->name('update');
                Route::delete('/{id}', [CouponController::class, 'destroy'])->name('destroy');
            });
        });
