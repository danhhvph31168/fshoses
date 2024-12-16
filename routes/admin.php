<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\{
    RoleController,
    UserController,
    BrandController,
    OrderController,
    BannerController,
    ReviewController,
    ProductController,
    CategoryController,
    DashboardController,
    ProductSizeController,
    ProductColorController,
    CouponController
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
                Route::put('/{id}/update',     [CategoryController::class, 'updateStatus'])->name('updateStatus');
            });

        // coupon
        Route::prefix('coupons')->as('coupons.')->group(function () {
            Route::get('/',         [CouponController::class, 'index'])->name('index');
            Route::get('/create',   [CouponController::class, 'create'])->name('create');
            Route::post('/store',   [CouponController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [CouponController::class, 'edit'])->name('edit');
            Route::put('/{id}',     [CouponController::class, 'update'])->name('update');
            Route::delete('/{id}',  [CouponController::class, 'destroy'])->name('destroy');
            Route::put('/{id}/update',     [CouponController::class, 'updateStatus'])->name('updateStatus');
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
        Route::prefix('roles')->as('roles.')->group(function () {
            Route::put('/{id}/update',   [RoleController::class, 'updateStatus'])->name('updateStatus');
        });

        // auth
        Route::get('showFormLogin', [LoginController::class, 'showFormLogin'])->name('showFormLogin');
        Route::post('login',        [LoginController::class, 'login'])->name('login');
        Route::post('logout',       [LoginController::class, 'logout'])->name('logout');

        // products
        Route::resource('products', ProductController::class);
        Route::prefix('products')->as('products.')->group(function () {
            Route::put('/{id}/update',   [ProductController::class, 'updateProduct'])->name('updateProduct');
        });

        // product sizes
        Route::resource('productSizes', ProductSizeController::class);
        Route::prefix('productSizes')->as('productSizes.')->group(function () {
            Route::put('/{id}/update',   [ProductSizeController::class, 'updateStatus'])->name('updateStatus');
        });

        // product colors
        Route::resource('productColors', ProductColorController::class);
        Route::prefix('productColors')->as('productColors.')->group(function () {
            Route::put('/{id}/update',   [ProductColorController::class, 'updateStatus'])->name('updateStatus');
        });

        // brands
        Route::resource('brands', BrandController::class);
        Route::prefix('brands')->as('brands.')->group(function () {
            Route::put('/{id}/update',   [BrandController::class, 'updateStatus'])->name('updateStatus');
        });

        // banners
        Route::resource('banners', BannerController::class);
        Route::prefix('banners')->as('banners.')->group(function () {
            Route::put('/{id}/update',   [BannerController::class, 'updateStatus'])->name('updateStatus');
        });
    });
