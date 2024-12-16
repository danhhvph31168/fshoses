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

   

    // public function listProductByBrand(Brand $brd)
    // {
    //     $prds = $brd->products()->paginate(3);

    //     return view('client.products.productByBrand', compact('brd', 'prds'));
    // }

    // public function listProductByCategory(Category $cate)
    // {
    //     $prds = $cate->products()->where('status', '1')->paginate(3);

    //     return view('client.products.productByCategory', compact('cate', 'prds'));
    // }

    // public function listProductByBrand(Brand $brd)
    // {
    //     $prds = $brd->products()->paginate(3);

    //     return view('client.products.productByBrand', compact('brd', 'prds'));
    // }

    // public function listProductByCategory(Category $cate)
    // {
    //     $prds = $cate->products()->paginate(3);
    //     // dd($prds);

    //     return view('client.products.productByCategory', compact('cate', 'prds'));
    // }
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

    // public function listProductByCategory(Category $cate, Request $request)
    // {
    //     if ($request->ajax()) {
    //         $prds = $cate->products()->paginate(3);
    //         $html = view('client.partials.products', compact('prds'))->render();

    //         return response()->json([
    //             'html' => $html,
    //             'pagination' => $prds->links('pagination::bootstrap-4')->toHtml()
    //         ]);
    //     }

    //     $prds = $cate->products()->paginate(3);
    //     return view('client.products.productByCategory', compact('cate', 'prds'));
    // }


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

    $prds = $cate->products()->paginate(3);
    return view('client.products.productByCategory', compact('cate', 'prds', 'selectedCategory'));
}



    public function productDetail($slug)
    {
        $product = Product::query()->with(['productVariants', 'category', 'galleries', 'ratings'])->where('slug', $slug)->first();

        if (!$product) {
            abort(404);
        }

        $productGalleries =  $product->galleries()->limit(4)->get();

        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        $relatedProducts = Product::with(['galleries', 'productVariants'])
            ->where('category_id', $product->category_id)
            ->where('id', '<>', $product->id)
            ->limit(4)->get();

        $averageRating = $product->averageRating();
        $totalRatings = $product->totalRatings();
        $ratingBreakdown = $product->ratingBreakdown();

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