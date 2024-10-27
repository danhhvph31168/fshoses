<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\ReviewController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('admin.')
    ->group(function () {

        //dashboard
        Route::get('/', [DashboardController::class, 'orderStatistical']);
        Route::post('/',[DashboardController::class, 'orderStatistical'])->name('dashboard.year');


        // order
        Route::get('orders',            [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/create',     [OrderController::class, 'create'])->name('orders.create');
        Route::post('orders/store',     [OrderController::class, 'store'])->name('orders.store');
        Route::get('orders/{id}/edit',  [OrderController::class, 'edit'])->name('orders.edit');
        Route::put('orders/{id}/update',[OrderController::class, 'update'])->name('orders.update');

        //refund
        Route::get('refunds',               [RefundController::class, 'index'])->name('refunds.index');
        Route::post('refunds/store',        [RefundController::class, 'store'])->name('refunds.store');
        Route::put('refunds/{id}/update',   [RefundController::class, 'update'])->name('refunds.update');

        //review
        Route::get('reviews',               [ReviewController::class, 'index'])->name('reviews.index');
        Route::put('reviews/{id}/update',   [ReviewController::class, 'update'])->name('reviews.update');


    });
