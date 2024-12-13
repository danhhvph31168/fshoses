<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\{
    RoleController,
    UserController,
    BrandController,
    OrderController,
    BannerController,
    CouponController,
    ReviewController,
    ProductController,
    CategoryController,
    DashboardController,
    ProductSizeController,
    ProductColorController,
};

Route::prefix('admin')->as('admin.')
    ->as('admin.')
    ->middleware(['auth', 'auth.admin'])
    ->group(function () {

        // dashboard
        Route::get('/',  [DashboardController::class, 'orderStatistical']);
        Route::post('/', [DashboardController::class, 'orderStatistical'])->name('dashboard.year');
        Route::get('/dashboard/exportProduct',  [DashboardController::class, 'exportProduct'])->name('dashboard.exportProduct');
        Route::get('/dashboard/exportCategory', [DashboardController::class, 'exportCategory'])->name('dashboard.exportCategory');

        // order
        Route::get('orders',            [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/create',     [OrderController::class, 'create'])->name('orders.create');
        Route::post('orders/store',     [OrderController::class, 'store'])->name('orders.store');
        Route::get('orders/{id}/edit',  [OrderController::class, 'edit'])->name('orders.edit');
        Route::put('orders/{id}/update', [OrderController::class, 'update'])->name('orders.update');
        Route::get('orders/search',     [OrderController::class, 'search'])->name('orders.search');

        // review
        Route::get('reviews',               [ReviewController::class, 'index'])->name('reviews.index');
        Route::get('reviews/{id}/show',     [ReviewController::class, 'show'])->name('reviews.show');
        Route::put('reviews/{id}/update',   [ReviewController::class, 'update'])->name('reviews.update');

        // categories
        Route::prefix('categories')
            ->as('categories.')
            ->group(function () {
                Route::get('/',                 [CategoryController::class, 'index'])->name('index');
                Route::get('create',            [CategoryController::class, 'create'])->name('create');
                Route::post('store',            [CategoryController::class, 'store'])->name('store');
                Route::get('{id}/edit',         [CategoryController::class, 'edit'])->name('edit');
                Route::put('{id}/update',       [CategoryController::class, 'update'])->name('update');
                Route::delete('{id}/destroy',   [CategoryController::class, 'destroy'])->name('destroy');
            });

        // coupon
        Route::prefix('coupons')->as('coupons.')->group(function () {
            Route::get('/',         [CouponController::class, 'index'])->name('index');
            Route::get('/create',   [CouponController::class, 'create'])->name('create');
            Route::post('/store',   [CouponController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [CouponController::class, 'edit'])->name('edit');
            Route::put('/{id}',     [CouponController::class, 'update'])->name('update');
            Route::delete('/{id}',  [CouponController::class, 'destroy'])->name('destroy');
        });

        // users
        Route::prefix('users')->as('users.')->group(function () {
            Route::get('/',         [UserController::class, 'index'])->name('index');
            Route::get('/{id}/show',         [UserController::class, 'show'])->name('show');
            Route::get('/create',   [UserController::class, 'create'])->name('create');
            Route::post('/store',   [UserController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{id}',     [UserController::class, 'update'])->name('update');
            Route::delete('/{id}',  [UserController::class, 'destroy'])->name('destroy');
            Route::get('/customers', [UserController::class, 'listCustomer'])->name('listCustomer');
            Route::put('/{id}/update',   [UserController::class, 'updateCustomer'])->name('updateCustomer');
        });


        // roles
        Route::resource('roles', RoleController::class);

        // auth
        Route::get('showFormLogin', [LoginController::class, 'showFormLogin'])->name('showFormLogin');
        Route::post('login',        [LoginController::class, 'login'])->name('login');
        Route::post('logout',       [LoginController::class, 'logout'])->name('logout');

        // products
        Route::resource('products', ProductController::class);

        // product sizes
        Route::resource('productSizes', ProductSizeController::class);

        // product colors
        Route::resource('productColors', ProductColorController::class);

        // brands
        Route::resource('brands', BrandController::class);

        // banners
        Route::resource('banners', BannerController::class);
    });
