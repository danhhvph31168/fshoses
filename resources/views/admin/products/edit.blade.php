@extends('admin.layouts.master')

@section('title')
    Update Products
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box  align-items-center">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                        <li class="breadcrumb-item text-info">Update: <span class="text-danger"> {{ $product->name }}</span>
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    @if ($errors->any() || session('error'))
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        @if ($errors->any())
                            <div class="alert alert-danger" style="width: 100%;">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" style="width: 100%;">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Hiển thị thông báo thành công --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismis="alert" aria-label="Close">
            </button>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Thông tin --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Information</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div class="mt-3">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $product->name }}">
                                    </div>

                                    <div class="mt-3">
                                        <label for="brand_id" class="form-label">Brands:</label>
                                        <select name="brand_id" id="brand_id" type="text" class="form-select">
                                            @foreach ($brands as $id => $name)
                                                <option value="{{ $id }}" @selected($product->brand_id === $id)>
                                                    {{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-3">
                                        <label for="category_id" class="form-label">Categories:</label>
                                        <select name="category_id" id="category_id" type="text" class="form-select">
                                            @foreach ($categories as $id => $name)
                                                <option value="{{ $id }}" @selected($product->category_id === $id)>
                                                    {{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-3">
                                        <label for="sku" class="form-label">SKU:</label>
                                        <input type="text" class="form-control" id="sku" name="sku"
                                            value="{{ $product->sku }}">
                                    </div>

                                    <div class="mt-3">
                                        <label for="price_regular" class="form-label">Price Regular:</label>
                                        <input type="number" class="form-control" id="price_regular" name="price_regular"
                                            value="{{ $product->price_regular }}">
                                    </div>

                                    <div class="mt-3">
                                        <label for="price_sale" class="form-label">Price Sale:</label>
                                        <input type="number" class="form-control" id="price_sale" name="price_sale"
                                            value="{{ $product->price_sale }}">
                                    </div>

                                    <div class="mt-3">
                                        <label for="img_thumbnail" class="form-label">Img Thumbnail:</label>
                                        <input type="file" class="form-control" id="img_thumbnail" name="img_thumbnail">
                                        @if ($product->img_thumbnail)
                                            <img src="{{ \Storage::url($product->img_thumbnail) }}" width="100px"
                                                class="mt-3">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="row">
                                        @php
                                            $is = [
                                                'is_active' => 'info',
                                                'is_hot_deal' => 'secondary',
                                                'is_show_home' => 'danger',
                                            ];
                                        @endphp

                                        @foreach ($is as $key => $color)
                                            <div class="col-md-2">
                                                <div class="form-check form-switch form-switch-{{ $color }}">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="{{ $key }}" value="1"
                                                        id="{{ $key }}" @checked($product->$key)>
                                                    <label class="form-check-label"
                                                        for="{{ $key }}">{{ \Str::convertCase($key, MB_CASE_TITLE) }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mt-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="2">{{ $product->description }}</textarea>
                                            </div>

                                            <div class="mt-3">
                                                <label for="content" class="form-label">Content</label>
                                                <textarea class="form-control" id="content" name="content">{!! $product->content !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- // Biến thể --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Variants</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" style="height:400px; overflow:scroll">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Quantity</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php

                                            $productVariants = [];
                                            $product->productVariants->map(function ($item) use (&$productVariants) {
                                                $key = $item->product_size_id . '-' . $item->product_color_id;

                                                $productVariants[$key] = [
                                                    'quantity' => $item->quantity,
                                                    'image' => $item->image,
                                                ];
                                            });
                                        @endphp

                                        @foreach ($sizes as $sizeID => $sizeName)
                                            @php($flagRowspan = true)

                                            @foreach ($colors as $colorID => $colorName)
                                                <tr class="text-center align-middle">
                                                    @if ($flagRowspan)
                                                        <td style="vertical-align: middle;"
                                                            rowspan="{{ count($colors) }}"><b>{{ $sizeName }}</b>
                                                        </td>
                                                    @endif

                                                    @php($flagRowspan = false)

                                                    @php($key = $sizeID . '-' . $colorID)

                                                    <td>{{ $colorName }}</td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                            value="{{ $productVariants[$key]['quantity'] }}"
                                                            name="product_variants[{{ $key }}][quantity]">
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control"
                                                            name="product_variants[{{ $key }}][image]">
                                                        <input type="hidden" class="form-control"
                                                            value="{{ $productVariants[$key]['image'] }}"
                                                            name="product_variants[{{ $key }}][current_image]">
                                                    </td>
                                                    <td>
                                                        @if ($productVariants[$key]['image'])
                                                            <img src="{{ \Storage::url($productVariants[$key]['image']) }}"
                                                                width="80px" height="80px">
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Gallery --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Gallery: </h4>
                        <button type="button" class="btn btn-primary" onclick="addImageGallery()">Add Gallery</button>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="gallery_list">
                                @if (count($product->galleries) > 0)
                                    @foreach ($product->galleries as $item)
                                        <div class="col-md-4" id="storage_{{ $item->id }}_item">
                                            <label for="gallery_default" class="form-label">Image:</label>
                                            <div class="d-flex">
                                                <input type="file" class="form-control me-2"
                                                    name="product_galleries[]" id="gallery_default">
                                                <img src="{{ \Storage::url($item->image) }}" width="100px"
                                                    height="60px" alt="">
                                                <button type="button" class="btn btn-danger ms-2"
                                                    onclick="removeImageGallery('storage_{{ $item->id }}_item', '{{ $item->id }}', '{{ $item->image }}')">
                                                    <span class="bx bx-trash"></span>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-4" id="gallery_default_item">
                                        <label for="gallery_default" class="form-label">Image</label>
                                        <div class="d-flex">
                                            <input type="file" class="form-control" name="product_galleries[]"
                                                id="gallery_default">
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Thằng này dùng để lưu ảnh xóa --}}
                            <div id="delete_galleries"></div>
                        </div>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div><!-- end card header -->
                </div>
            </div>
            <!--end col-->
        </div>
    </form>
@endsection

@section('css')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('content');

        function addImageGallery() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
                <div class="col-md-4" id="${id}_item">
                    <label for="${id}" class="form-label">Image</label>
                    <div class="d-flex">
                        <input type="file" class="form-control me-2" name="product_galleries[]" id="${id}">
                        <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                            <span class="bx bx-trash"></span>
                        </button>
                    </div>
                </div>
            `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();
            }
        }
    </script>
@endsection
