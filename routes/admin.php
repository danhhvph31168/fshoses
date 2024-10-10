<?php

use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('orders',        [OrderController::class,'index'])->name('orders.index');
        Route::get('orders/create', [OrderController::class,'create'])->name('orders.create');
        Route::post('orders/store', [OrderController::class,'store'])->name('orders.store');

    });

