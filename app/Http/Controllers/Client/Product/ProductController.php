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

    public function productDetail($slug)
    {
        $product = Product::query()->with(['productVariants', 'category', 'galleries'])->where('slug', $slug)->first();


        // Kiểm tra sản phẩm có tồn tại hay không
        if (!$product) {
            abort(404);
        }
        // Lấy 4 hình ảnh của sản phẩm galleries
        $productGalleries =  $product->galleries()->limit(4)->get();

        // Lấy danh sách màu sắc và kích thước
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        // Lấy các bình luận cho sản phẩm
        $comments = Review::with('user')->where('product_id', $product->id)
            ->where('is_show', 0)
            ->orderBy('id', 'DESC')->get();

        // Lấy các sản phẩm liên quan dựa trên danh mục của sản phẩm hiện tại
        $relatedProducts = Product::with(['galleries', 'productVariants'])->where('category_id', $product->category_id)->where('id', '<>', $product->id)->limit(4)->get();
        // Thông tin đánh giá
        $averageRating = $product->averageRating();
        $totalRatings = $product->totalRatings();
        $ratingBreakdown = $product->ratingBreakdown();

        return view('client.products.product-detail', compact('product', 'colors', 'sizes', 'comments', 'relatedProducts', 'productGalleries', 'averageRating', 'totalRatings', 'ratingBreakdown'));
    }
}
