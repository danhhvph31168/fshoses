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
        $getAllProducts = Product::query()->latest('id')->paginate(9);

        return view('client.products.product-list', compact('getAllProducts'));
    }

    // public function getCategory($category_id)
    // {

    //     $category = Category::find($category_id);


    //     $products = $category->products()->take(4)->get();

    //     dd($products);

    //     return view('client.home', compact('category', 'products'));
    // }

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

    // public function search(Request $request)
    // {
    //     $query = Product::query();

    //     // Tìm kiếm theo tên sản phẩm (có thể sử dụng LIKE cho tìm kiếm gần đúng)
    //     if ($request->has('name') && $request->name != '') {
    //         $query->where('name', 'like', '%' . $request->name . '%');
    //     }

    //     // Tìm kiếm theo giá (có thể thêm điều kiện giá lớn hơn hoặc nhỏ hơn tùy vào yêu cầu)
    //     if ($request->has('min_price') && $request->min_price != '') {
    //         $query->where('price', '>=', $request->min_price);
    //     }

    //     if ($request->has('max_price') && $request->max_price != '') {
    //         $query->where('price', '<=', $request->max_price);
    //     }

    //     // Thực hiện truy vấn và trả về kết quả
    //     $prod = $query->get();

    //     return view('client.home', compact('prod'));
    // }
}
