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
        // $product = Product::query()->with(['variants', 'category', 'brand'])->latest('id')->limit(4);

        $products = Product::query()->where('status', '1')
            ->with(['productVariants', 'category', 'brand'])->orderBy('name', 'asc')->limit(9)->get();

        // $categories = Category::query()->with(['products'])->where('is_active', '1')
        //     ->orderBy('name', 'ASC')->get();
        $categories = Category::query()->with('products')->get();

        $brands = Brand::query()->where('status', '1')->get();

        $listLatestProduct = Product::query()->latest('id')->limit(12)->get();

        $banners = Banner::query()->where('status', '1')->orderBy('name', 'asc')->get();

        return view('client.home', compact('products', 'categories', 'brands', 'listLatestProduct', 'banners'));
    }

    public function getAllProducts()
    {
        $data = Product::query()->latest('id')->paginate(9);

        $from = request()->from;
        $to = request()->to;
        $key = request()->key;

        if ($key && $from && $to) {
            $data = Product::query()->latest('id')
                ->where('name', 'like', '%' . $key . '%')
                ->whereBetween('price_regular', [$from, $to])
                ->paginate(9);
        } elseif ($key && $from) {
            $data = Product::query()->latest('id')
                ->where('name', 'like', '%' . $key . '%')
                ->WhereBetween('price_regular', [$from, Product::max('price_regular')])
                ->paginate(9);
        } elseif ($key && $to) {
            $data = Product::query()->latest('id')
                ->where('name', 'like', '%' . $key . '%')
                ->WhereBetween('price_regular', [Product::min('price_regular'), $to])
                ->paginate(9);
        } elseif ($to && $from) {
            $data = Product::query()->latest('id')
                // ->where('name', 'like', '%' . $key . '%')
                ->WhereBetween('price_regular', [$from, $to])
                ->paginate(9);
        } elseif ($key) {
            $data = Product::query()->latest('id')
                ->where('name', 'like', '%' . $key . '%')
                ->paginate(9);
        } elseif ($from) {
            $data = Product::query()->latest('id')
                ->WhereBetween('price_regular', [$from, Product::max('price_regular')])
                ->paginate(9);
        } elseif ($to) {
            $data = Product::query()->latest('id')
                ->WhereBetween('price_regular', [Product::min('price_regular'), $to])
                ->paginate(9);
        }

        return view('client.products.product-list', compact('data', 'from', 'to'));
    }

    public function listProductByBrand(Brand $brd)
    {
        $prds = $brd->products()->paginate(4);

        $from = request()->from;
        $to = request()->to;
        $key = request()->key;

        if ($key) {
            $prds = $brd->products()->latest('id')
                ->where('name', 'like', '%' . $key . '%')
                ->paginate(4);
        } elseif ($to) {
            $prds = $brd->products()->latest('id')
                ->WhereBetween('price_regular', [$from = 0, $to])
                ->paginate(4);
        } elseif ($from) {
            $prds = $brd->products()->latest('id')
                ->WhereBetween('price_regular', [$from, Product::max('price_regular')])
                ->paginate(4);
        } elseif ($key && $from && $to) {
            $prds = $brd->products()->latest('id')
                ->where('name', 'like', '%' . $key . '%')->whereBetween('price_regular', [$from, $to])
                ->paginate(4);
        } elseif ($from && $key) {
            $prds = $brd->products()->latest('id')
                ->where('name', 'like', '%' . $key . '%')->WhereBetween('price_regular', [$from, Product::max('price_regular')])
                ->paginate(4);
        }

        // dd($prds);
        return view('client.products.productByBrand', compact('brd', 'prds', 'from', 'to'));
    }

    public function listProductByCategory(Category $cate)
    {
        $prds = $cate->products()->paginate(4);

        if ($key = request()->key) {
            $prds = $cate->products()->latest('id')
                ->where('name', 'like', '%' . $key . '%')
                ->paginate(3);
        }
        return view('client.products.productByCategory', compact('cate', 'prds'));
    }
}
