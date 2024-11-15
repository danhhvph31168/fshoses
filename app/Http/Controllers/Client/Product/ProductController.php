<?php

namespace App\Http\Controllers\Client\Product;

use App\Models\Brand;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        // $product = Product::query()->with(['variants', 'category', 'brand'])->latest('id')->limit(4);

        $products = Product::query()->where('status', '1')
            ->with(['productVariants', 'category', 'brand'])->get();

        $categories = Category::query()->with(['products'])->where('is_active', '1')
        ->orderBy('name', 'ASC')->get();

        $brands = Brand::query()->where('status', '1')->get();

        $listLatestProduct = Product::query()->latest('id')->limit(10)->get();

        // dd($brands);

        return view('client.home', compact('products', 'categories', 'brands', 'listLatestProduct'));
    }


    public function getCategory($category_id)
    {
        // $data['items'] = Product::where('id', $id)->orderBy('name', 'asc')->paginate(3);

        $category = Category::find($category_id);


        $products = $category->products()->take(4)->get();

        dd($products);

        return view('client.home', compact('category', 'products'));
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
