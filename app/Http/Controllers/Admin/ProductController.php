<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.products.';
    public function index()
    {

        if (Auth::user()->role_id == 1) {
            $brands = Brand::pluck('name', 'id')->all();
            $categories = Category::pluck('name', 'id')->all();

            $data = Product::query()->with(['category', 'brand'])->latest('id')->paginate(5);

            return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'brands', 'categories'));
        } else {

            return back()->with('error', 'Access denied!');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (Auth::user()->role_id == 1) {

            $categories = Category::query()->pluck('name', 'id')->all();

            $colors = ProductColor::query()->pluck('name', 'id')->all();

            $sizes = ProductSize::query()->pluck('name', 'id')->all();

            $brands = Brand::query()->pluck('name', 'id')->all();

            return view(self::PATH_VIEW . __FUNCTION__, compact('categories', 'sizes', 'colors', 'brands'));
        } else {
            return back()->with('error', 'Access denied!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        if (Auth::user()->role_id == 1) {

            list($dataProduct, $dataProductVariants, $dataProductGalleries)
                = $this->handleData($request);

            try {
                DB::beginTransaction();

                $product = Product::query()->create($dataProduct);

                foreach ($dataProductVariants as $item) {
                    $item += ['product_id' => $product->id];
                    ProductVariant::query()->create($item);
                }

                foreach ($dataProductGalleries as $item) {
                    $item += ['product_id' => $product->id];
                    ProductGallery::query()->create($item);
                }

                DB::commit();

                return redirect()->route('admin.products.index')
                    ->with('success', 'Product created Successfully!');
            } catch (\Throwable $th) {
                DB::rollBack();
                dd($th->getMessage());

                if (!empty($dataProduct['img_thumbnail']) && Storage::exists($dataProduct['img_thumbnail'])) {
                    Storage::delete($dataProduct['img_thumbnail']);
                }

                foreach ($dataProductVariants as $item) {
                    if (!empty($item['image']) && Storage::exists($item['image'])) {
                        Storage::delete($item['image']);
                    }
                }

                if (!empty($dataProductGalleries['image']) && Storage::exists($dataProductGalleries['image'])) {
                    Storage::delete($dataProductGalleries['image']);
                }

                return back()->with('error', $th->getMessage());
            }
        } else {
            return back()->with('error', 'Access denied!');
        }
    }


    public function show(Product $product)
    {
        $user = Auth::user();
        if ($user->role_id === 1) {
            $product->load(relations: [
                'category',
                'galleries',
                'productVariants',
                'brand',
            ]);
            $categories = Category::pluck('name', 'id')->all();
            $colors = ProductColor::query()->pluck('name', 'id')->all();
            $sizes = ProductSize::query()->pluck('name', 'id')->all();
            $brands = Brand::query()->pluck('name', 'id')->all();

            if (count($product->galleries) > 0) {
                foreach ($product->galleries as $item) {
                    $img = $item->image;
                }
            }

            return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'categories', 'colors', 'sizes', 'brands'));
        } else {
            return back()->with('error', 'Access denied!');
        }
    }


    public function edit(Product $product)
    {
        if (Auth::user()->role_id == 1) {
            $product->load([
                'category',
                'galleries',
                'productVariants',
                'brand',
            ]);

            $categories = Category::query()->pluck('name', 'id')->all();
            $colors = ProductColor::query()->pluck('name', 'id')->all();
            $sizes = ProductSize::query()->pluck('name', 'id')->all();
            $brands = Brand::query()->pluck('name', 'id')->all();

            return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'categories', 'colors', 'sizes', 'brands'));
        } else {
            return back()->with('error', 'Access denied!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if (Auth::user()->role_id == 1) {
            list($dataProduct, $dataProductVariants, $dataProductGalleries, $dataDeleteGalleries)
                = $this->handleData($request);

            try {
                DB::beginTransaction();

                $productImgThumbnailCurrent = $product->img_thumbnail;

                $product->update($dataProduct);

                foreach ($dataProductVariants as $item) {
                    $item += ['product_id' => $product->id];
                    ProductVariant::query()->updateOrCreate(
                        [
                            'product_id'        => $item['product_id'],
                            'product_size_id'   => $item['product_size_id'],
                            'product_color_id'  => $item['product_color_id'],
                        ], // điều kiện check tồn tại để cập nhật và thêm mới
                        $item
                    );
                }


                foreach ($dataProductGalleries as $item) {
                    $item += ['product_id' => $product->id];
                    ProductGallery::query()->updateOrCreate(
                        [
                            'id' => $item['id'],
                        ],
                        $item
                    );
                }

                DB::commit();

                foreach ($request->product_variants as $item) {
                    if ((isset($item['image']) == true) && Storage::exists($item['current_image']) && !empty($item['current_image'])) {
                        Storage::delete($item['current_image']);
                    }
                }

                if (!empty($dataDeleteGalleries)) {
                    foreach ($dataDeleteGalleries as $id => $path) {
                        ProductGallery::query()->where('id', $id)->delete();

                        if (!empty($path) && Storage::exists($path)) {
                            Storage::delete($path);
                        }
                    }
                }

                if (
                    !empty($productImgThumbnailCurrent) && Storage::exists($productImgThumbnailCurrent)
                    && (isset($request->img_thumbnail) == true)
                ) {
                    Storage::delete($productImgThumbnailCurrent);
                }

                return back()->with('success', 'Product updated successfully!');
            } catch (\Throwable $th) {
                DB::rollBack();

                if (!empty($dataProduct['img_thumbnail']) && Storage::exists($dataProduct['img_thumbnail'])) {
                    Storage::delete($dataProduct['img_thumbnail']);
                }

                foreach ($dataProductVariants as $item) {
                    if (!empty($item['image']) && Storage::exists($item['image'])) {
                        Storage::delete($item['image']);
                    }
                }

                foreach ($dataProductGalleries as $item) {
                    if (!empty($item['image']) && Storage::exists($item['image'])) {
                        Storage::delete($item['image']);
                    }
                }
                echo 2;
                dd($th->getMessage());
                return back()->with('error', $th->getMessage());
            }
        } else {
            return back()->with('error', 'Access denied!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (Auth::user()->role_id == 1) {
            try {

                DB::transaction(function () use ($product) {

                    $product->galleries()->delete();

                    foreach ($product->variants as $item) {
                        $item->orderItems()->delete();
                    }

                    $product->variants()->delete();

                    $product->delete();
                }, 3);

                if (!empty($product->img_thumbnail) && Storage::exists($product->img_thumbnail)) {
                    Storage::delete($product->img_thumbnail);
                }

                foreach ($product->variants as $item) {
                    if (!empty($item['image']) && Storage::exists($item['image'])) {
                        Storage::delete($item['image']);
                    }
                }

                foreach ($product->galleries as $item) {
                    if (!empty($item['image']) && Storage::exists($item['image'])) {
                        Storage::delete($item['image']);
                    }
                }

                return back()->with('success', 'Product deleted successfully');
            } catch (\Exception $exception) {
                dd($exception->getMessage());
                return back()->with('error', $exception->getMessage());
            }
        } else {
            return back()->with('error', 'Access denied!');
        }
    }

    private function handleData(Request $request)
    {
        if (Auth::user()->role_id == 1) {
            $dataProduct = $request->except('product_variants', 'product_galleries');
            $dataProduct['is_active']       ??= 0;
            $dataProduct['is_hot_deal']     ??= 0;
            $dataProduct['is_good_deal']    ??= 0;
            $dataProduct['is_new_deal']     ??= 0;
            $dataProduct['is_show_home']    ??= 0;
            $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];

            if (!empty($dataProduct['img_thumbnail'])) {
                $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
            }

            $dataProductVariantsTmp = $request->product_variants;
            $dataProductVariants = [];
            foreach ($dataProductVariantsTmp as $key => $item) {
                $tmp = explode('-', $key);

                $image = !empty($item['image'])
                    ? Storage::put('product_variants', $item['image']) : ($item['current_image'] ?? null);

                $dataProductVariants[] = [
                    'product_size_id' => $tmp[0],
                    'product_color_id' => $tmp[1],
                    'quantity' => $item['quantity'],
                    'image' => $image
                ];
            }

            $dataProductGalleriesTmp = $request->product_galleries ?: [];
            $dataProductGalleries = [];
            foreach ($dataProductGalleriesTmp as $image) {
                if (!empty($image)) {
                    $dataProductGalleries[] = [
                        'id' => $item['id'] ?? null,
                        'image' => Storage::put('product_galleries', $image)
                    ];
                }
            }

            $dataDeleteGalleries = $request->delete_galleries;

            return [$dataProduct, $dataProductVariants, $dataProductGalleries, $dataDeleteGalleries];
        } else {
            return back()->with('error', 'Access denied!');
        }
    }
}
