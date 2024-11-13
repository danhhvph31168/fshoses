
<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleController;

Route::prefix('admin')->as('admin.')
    ->as('admin.')
    ->middleware(['auth', 'auth.admin'])
    ->group(function () {

        // dashboard
        Route::get('/',  [DashboardController::class, 'orderStatistical']);
        Route::post('/', [DashboardController::class, 'orderStatistical'])->name('dashboard.year');



        // order
        Route::get('orders',            [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/create',     [OrderController::class, 'create'])->name('orders.create');
        Route::post('orders/store',     [OrderController::class, 'store'])->name('orders.store');
        Route::get('orders/{id}/edit',  [OrderController::class, 'edit'])->name('orders.edit');
        Route::put('orders/{id}/update', [OrderController::class, 'update'])->name('orders.update');

        // refund
        Route::get('refunds',               [RefundController::class, 'index'])->name('refunds.index');
        Route::post('refunds/store',        [RefundController::class, 'store'])->name('refunds.store');
        Route::put('refunds/{id}/update',   [RefundController::class, 'update'])->name('refunds.update');

        //review
        Route::get('reviews',               [ReviewController::class, 'index'])->name('reviews.index');
        Route::get('reviews/{id}/show',     [ReviewController::class, 'show'])->name('reviews.show');
        Route::put('reviews/{id}/update',   [ReviewController::class, 'update'])->name('reviews.update');

        // Route::get('/', function () {
        //     return view('admin.dashboard');
        // })->name('dashboard');


        Route::prefix('categories')
            ->as('categories.')
            ->group(function () {
                Route::get('/',             [CategoryController::class, 'index'])->name('index');
                Route::get('create',        [CategoryController::class, 'create'])->name('create');
                Route::post('store',        [CategoryController::class, 'store'])->name('store');
                Route::get('show/{id}',     [CategoryController::class, 'show'])->name('show');
                Route::get('{id}/edit',     [CategoryController::class, 'edit'])->name('edit');
                Route::put('{id}/update',   [CategoryController::class, 'update'])->name('update');
                Route::get('{id}/destroy',  [CategoryController::class, 'destroy'])->name('destroy');
            });

        Route::resource('products', ProductController::class);
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('brands', BrandController::class);

        // auth
        Route::get('showFormLogin', [LoginController::class, 'showFormLogin'])->name('showFormLogin');
        Route::post('login',        [LoginController::class, 'login'])->name('login');
        Route::post('logout',        [LoginController::class, 'logout'])->name('logout');
    });
