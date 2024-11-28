<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        view()->composer('client.layouts.header', function ($view) {
            $brd = Brand::orderBy('name', 'ASC')->where('status', 1)->get();
            $cate = Category::orderBy('name', 'ASC')->where('is_active', 1)->get();
            $view->with(compact('brd', 'cate'));
        });

        view()->composer('client.layouts.sidebar', function ($view) {
            $brd = Brand::orderBy('name', 'ASC')->where('status', 1)->get();
            $cate = Category::orderBy('name', 'ASC')->where('is_active', 1)->get();
            $view->with(compact('brd', 'cate'));
        });
    }
}
