<?php

namespace App\Http\Controllers\Client\Product;

use App\Models\Brand;
use App\Models\Banner;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->where('is_active', '1')
            ->with(['productVariants', 'category', 'brand'])
            ->orderBy('name', 'asc')->limit(9)->get();

        $categories = Category::query()->with('products')->get();

        $brands = Brand::query()->where('status', '1')->get();

        $listLatestProduct = Product::query()->latest('id')->limit(12)->get();

        $banners = Banner::query()->where('status', '1')
            ->orderBy('name', 'asc')->get();

        return view(
            'client.home',
            compact(
                'products',
                'categories',
                'brands',
                'listLatestProduct',
                'banners'
            )
        );
    }

    public function getAllProducts()
    {
        $getAllProducts = Product::query()->paginate(9);

        return view('client.products.product-list', compact('getAllProducts'));
    }

    public function listProductByBrand(Brand $brd)
    {
        $prds = $brd->products()->paginate(3);

        return view('client.products.productByBrand', compact('brd', 'prds'));
    }

    public function listProductByCategory(Category $cate)
    {
        $prds = $cate->products()->paginate(3);

        return view('client.products.productByCategory', compact('cate', 'prds'));
    }
}
