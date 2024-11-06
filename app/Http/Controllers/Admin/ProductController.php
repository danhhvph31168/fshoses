<?php

namespace App\Http\Controllers\Admin;

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
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    const PATH_VIEW = 'admin.products.';

    public function index()
    {
        $user = Auth::user();
        if ($user->role_id === 1) {
            $data = Product::with('category')->latest('id')->paginate(10);

            // dd($data);

            return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();


        $user = Auth::user();
        if ($user->role_id === 1) {
            return view(self::PATH_VIEW . __FUNCTION__, compact('categories', 'colors', 'sizes'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }


    public function store(StoreProductRequest $request)
    {
        $user = Auth::user();
        if ($user->role_id === 1) {
            list(
                $dataProduct,
                $dataProductVariants,
                $dataProductGalleries
            ) = $this->handleData($request);

            try {
                DB::beginTransaction();

                // dd($dataProduct);

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

                return redirect()
                    ->route('admin.products.index')
                    ->with('success', 'Product added Successfully!');
            } catch (\Exception $exception) {
                DB::rollBack();

                if (
                    !empty($dataProduct['img_thumbnail'])
                    && Storage::exists($dataProduct['img_thumbnail'])
                ) {

                    Storage::delete($dataProduct['img_thumbnail']);
                }

                $dataHasImage = $dataProductVariants + $dataProductGalleries;
                foreach ($dataHasImage as $item) {
                    if (!empty($item['image']) && Storage::exists($item['image'])) {
                        Storage::delete($item['image']);
                    }
                }

                return back()->with('error', $exception->getMessage());
            }
        } else {
            return back()->with('error', 'Access denied!');
        };
    }


    private function handleData(StoreProductRequest|UpdateProductRequest $request)
    {
        $user = Auth::user();
        if ($user->role_id === 1) {
            $dataProduct = $request->except(['product_variants', 'product_galleries']);
            $dataProduct['is_active'] ??= 0;
            $dataProduct['is_hot_deal'] ??= 0;
            $dataProduct['is_show_home'] ??= 0;
            $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];
            if (!empty($dataProduct['img_thumbnail'])) {
                $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
            }

            $dataProductVariantsTmp = $request->product_variants;
            $dataProductVariants = [];
            foreach ($dataProductVariantsTmp as $key => $item) {
                $tmp = explode('-', $key);

                // current_image xuất hiện khi update
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
                        'id' => $item['id'] ?? null, // Tồn tại ID khi update
                        'image' => Storage::put('product_galleries', $image)
                    ];
                }
            }

            $dataDeleteGalleries = $request->delete_galleries;

            return [$dataProduct, $dataProductVariants, $dataProductGalleries, $dataDeleteGalleries];
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $user = Auth::user();
        if ($user->role_id === 1) {
            // $data = Product::query()->with('variants', 'galleries')->findOrFail($id);
            $product->load(relations: [
                'category',
                'galleries',
                'productVariants'
            ]);
            $categories = Category::pluck('name', 'id')->all();
            $colors = ProductColor::query()->pluck('name', 'id')->all();
            $sizes = ProductSize::query()->pluck('name', 'id')->all();

            if (count($product->galleries) > 0) {
                foreach ($product->galleries as $item) {
                    $img = $item->image;
                }
            }

            return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'categories', 'colors', 'sizes'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $user = Auth::user();
        if ($user->role_id === 1) {
            $product->load(relations: [
                'category',
                'galleries',
                'variants'
            ]);

            $categories = Category::query()->pluck('name', 'id')->all();
            $colors = ProductColor::query()->pluck('name', 'id')->all();
            $sizes = ProductSize::query()->pluck('name', 'id')->all();

            return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'categories', 'colors', 'sizes'));
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $user = Auth::user();
        if ($user->role_id === 1) {
            list(
                $dataProduct,
                $dataProductVariants,
                $dataProductGalleries,
                // $dataProductTags,
                $dataDeleteGalleries
            ) = $this->handleData($request);

            try {
                DB::beginTransaction();

                $productImgThumbnailCurrent = $product->img_thumbnail; // Lưu lại giá trị hiện tại để xóa

                /** @var Product $product */
                $product->update($dataProduct);

                foreach ($dataProductVariants as $item) {
                    $item += ['product_id' => $product->id];

                    ProductVariant::query()->updateOrCreate(
                        [
                            'product_id' => $item['product_id'],
                            'product_size_id' => $item['product_size_id'],
                            'product_color_id' => $item['product_color_id'],
                        ],
                        $item
                    );
                }

                // $product->tags()->sync($dataProductTags);

                foreach ($dataProductGalleries as $item) {
                    $item += ['product_id' => $product->id];

                    ProductGallery::query()->updateOrCreate(
                        [
                            'id' => $item['id']
                        ],
                        $item
                    );
                }

                DB::commit();

                if (!empty($dataDeleteGalleries)) {
                    foreach ($dataDeleteGalleries as $id => $path) {
                        ProductGallery::query()->where('id', $id)->delete();

                        if (!empty($path) && Storage::exists($path)) {
                            Storage::delete($path);
                        }
                    }
                }

                if (!empty($productImgThumbnailCurrent) && Storage::exists($productImgThumbnailCurrent) && $product->img_thumbnail != $productImgThumbnailCurrent) {
                    Storage::delete($productImgThumbnailCurrent);
                }

                return back()->with('success', 'Cập nhật sản phẩm thành công!');
            } catch (\Exception $exception) {
                DB::rollBack();

                if (
                    !empty($dataProduct['img_thumbnail'])
                    && Storage::exists($dataProduct['img_thumbnail'])
                ) {

                    Storage::delete($dataProduct['img_thumbnail']);
                }

                $dataHasImage = $dataProductVariants + $dataProductGalleries;

                foreach ($dataHasImage as $item) {
                    if (!empty($item['image']) && Storage::exists($item['image'])) {
                        Storage::delete($item['image']);
                    }
                }

                return back()->with('error', $exception->getMessage());
            }
        } else {
            return back()->with('error', 'Access denied!');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $user = Auth::user();
        if ($user->role_id === 1) {
            try {
                $dataHasImage = $product->galleries->toArray() + $product->variants->toArray();

                DB::transaction(function () use ($product) {

                    $product->galleries()->delete();

                    foreach ($product->variants as $variant) {
                        $variant->orderItems()->delete();
                    }
                    $product->variants()->delete();

                    $product->delete();
                }, 3);

                foreach ($dataHasImage as $item) {
                    if (!empty($item->image) && Storage::exists($item->image)) {
                        Storage::delete($item->image);
                    }
                }

                return back()->with('success', "Successfully Deleted. !");
            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }
        } else {
            return back()->with('error', 'Access denied!');
        };
    }
}
