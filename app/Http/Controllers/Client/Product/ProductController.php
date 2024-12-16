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
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->where('is_active', '1')
            ->with(['productVariants', 'category', 'brand'])
            ->orderBy('name', 'asc')->limit(9)->get();

        $categories = Category::query()->where('is_active', '1')->with('products')->get();

        $brands = Brand::query()->where('status', '1')->get();

        $listLatestProduct = Product::query()->where('is_active', '1')->latest('id')->limit(12)->get();

        $banners = Banner::query()->where('status', '1')
            ->orderBy('name', 'asc')->get();

        $orderCount = Product::query()->select(
            'products.id',
            DB::raw('SUM(order_items.quantity) as total_sold'),
            DB::raw('SUM(orders.total_amount) as total_amount'),
            DB::raw('count(orders.id) as count_orders'),
        )
            ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->join('order_items', 'product_variants.id', '=', 'order_items.product_variant_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status_order', Order::STATUS_ORDER_DELIVERED)
            ->where('products.id', $product->id ?? null)
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->first();

        return view(
            'client.home',
            compact(
                'products',
                'categories',
                'brands',
                'listLatestProduct',
                'banners',
                'orderCount'
            )
        );
    }

    public function getAllProducts()
    {
        $getAllProducts = Product::query()->paginate(9);

        return view('client.products.product-list', compact('getAllProducts'));
    }

    public function listProductByBrand(Brand $brd, Request $request)
    {
        if ($request->ajax()) {
            $prds = $brd->products()->paginate(3);
            $html = view('client.partials.products', compact('prds'))->render();

            return response()->json([
                'html' => $html,
                'pagination' => $prds->links('pagination::bootstrap-4')->toHtml()
            ]);
        }

        $prds = $brd->products()->paginate(3);
        return view('client.products.productByBrand', compact('brd', 'prds'));
    }

    public function listProductByCategory(Category $cate, Request $request)
    {
        $selectedCategory = $cate->id;
        if ($request->ajax()) {

            $prds = $cate->products()->paginate(3);
            $html = view('client.partials.products', compact('prds'))->render();

            return response()->json([
                'html' => $html,
                'pagination' => $prds->links('pagination::bootstrap-4')->toHtml()
            ]);
        }

        $prds = $cate->products()->latest('created_at')->paginate(3);
        return view('client.products.productByCategory', compact('cate', 'prds', 'selectedCategory'));
    }

    // public function listProductByStatus(Product $products, Request $request)
    // {
    //     $selectedProduct = $products->is_sale;
    //     if ($request->ajax()) {

    //         $prds =  $products->products()->paginate(3);
    //         $html = view('client.partials.products', compact('prds'))->render();

    //         return response()->json([
    //             'html' => $html,
    //             'pagination' => $prds->links('pagination::bootstrap-4')->toHtml()
    //         ]);
    //     }

    //     $prds =  $products->products()->paginate(3);
    //     return view('client.products.productByCategory', compact('cate', 'prds', 'selectedCategory'));
    // }

    public function productDetail(Request $request, $slug)
    {
        $product = Product::query()->with(['productVariants', 'category', 'galleries', 'ratings'])->where('slug', $slug)->first();

        // Kiểm tra sản phẩm có tồn tại hay không
        if (!$product) {
            abort(404);
        }

        // Lấy 4 hình ảnh của sản phẩm galleries
        $productGalleries =  $product->galleries()->limit(4)->get();

        // Lấy danh sách màu sắc và kích thước
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        // Lấy các sản phẩm liên quan dựa trên danh mục của sản phẩm hiện tại
        $relatedProducts = Product::with(['galleries', 'productVariants'])
            ->where('category_id', $product->category_id)
            ->where('id', '<>', $product->id)
            ->limit(4)->get();

        // Thông tin đánh giá
        $averageRating = $product->averageRating();
        $totalRatings = $product->totalRatings();
        $ratingBreakdown = $product->ratingBreakdown();

        if (!$request->session()->has('viewed_article_' . $product->id)) {
            $product->increment('views');
            $request->session()->put('viewed_article_' . $product->id, true);
        }

        $relatedProducts = Product::query()
            ->where('category_id', $product->category_id)
            ->limit(4)->get();

        return view('client.products.product-detail', compact(
            'product',
            'colors',
            'sizes',
            'relatedProducts',
            'productGalleries',
            'averageRating',
            'totalRatings',
            'ratingBreakdown',
            'relatedProducts'
        ));
    }
}
