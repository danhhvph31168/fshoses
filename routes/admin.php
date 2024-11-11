
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;





Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', 'auth.admin'])
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');


        Route::prefix('categories')
            ->as('categories.')
            ->group(function () {
                Route::get('/', [CategoryController::class, 'index'])->name('index');
                Route::get('create', [CategoryController::class, 'create'])->name('create');
                Route::post('store', [CategoryController::class, 'store'])->name('store');
                Route::get('show/{id}', [CategoryController::class, 'show'])->name('show');
                Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [CategoryController::class, 'update'])->name('update');
                Route::get('{id}/destroy',      [CategoryController::class, 'destroy'])->name('destroy');
            });

        Route::resource('products', ProductController::class);
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('orders', OrderController::class);
    });
