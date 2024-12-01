@extends('admin.layouts.master')

@section('title')
    Update Products
@endsection
@section('css')
    <link href="{{ URL::asset('theme/admin/assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" />
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
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                        </div>

                        <div class="mt-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" id="content" name="content">{!! $product->content !!}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Gallery</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="fs-14 mb-1">Product Image</h5>
                            <p class="text-muted">Img Thumbnail:</p>
                            <div class="text-center">
                                <div class="position-relative d-inline-block">
                                    <div class="position-absolute top-100 start-100 translate-middle">
                                        <label for="product-image-input" class="mb-0"  data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                            <div class="avatar-xs">
                                                <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                    <i class="ri-image-fill"></i>
                                                </div>
                                            </div>
                                        </label>
                                        <input class="form-control d-none" value="" id="product-image-input" name="img_thumbnail" type="file"
                                               accept="image/png, image/gif, image/jpeg">
                                    </div>
                                    <div class="avatar-lg">
                                        <div class="avatar-title bg-light rounded">
                                            <img src="{{preg_match('/^(http|https):\/\//', $product->img_thumbnail) ? $product->img_thumbnail : asset('storage/' . $product->img_thumbnail)}}" id="product-img" class="avatar-md h-auto"  alt=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h5 class="fs-14 mb-1">Product Gallery</h5>
                            <p class="text-muted">Add Product Gallery Images.</p>

                            <div class="dropzone">
                                <div class="fallback">
                                    <input name="product_galleries[]" type="file" multiple="multiple">
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                    </div>

                                    <h5>Drop files here or click to upload.</h5>
                                </div>
                            </div>

                            <ul class="list-unstyled mb-0" id="dropzone-preview">
                                <li class="mt-2" id="dropzone-preview-list">
                                    <div class="border rounded">
                                        <div class="d-flex p-2">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-sm bg-light rounded">
                                                    <img data-dz-thumbnail class="img-fluid rounded d-block" src="#" alt="Product-Image" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="pt-1">
                                                    <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                    <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-3">
                                                <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
{{--                                @if (count($product->galleries) > 0)--}}
{{--                                    @foreach ($product->galleries as $item)--}}
{{--                                        <li class="mt-2" id="dropzone-preview-list">--}}
{{--                                            <div class="border rounded">--}}
{{--                                                <div class="d-flex p-2">--}}
{{--                                                    <div class="flex-shrink-0 me-3">--}}
{{--                                                        <div class="avatar-sm bg-light rounded">--}}
{{--                                                            <img src="{{  preg_match('/^(http|https):\/\//', $item->image) ? $item->image : asset('storage/' . $item->image)  }}" data-dz-thumbnail class="img-fluid rounded d-block" alt="Product-Image" />--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="flex-grow-1">--}}
{{--                                                        <div class="pt-1">--}}
{{--                                                            <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>--}}
{{--                                                            <p class="fs-13 text-muted mb-0" data-dz-size></p>--}}
{{--                                                            <strong class="error text-danger" data-dz-errormessage></strong>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="flex-shrink-0 ms-3">--}}
{{--                                                        <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                @else--}}
{{--                                    <li class="mt-2" id="dropzone-preview-list">--}}
{{--                                        <!-- This is used as the file preview template -->--}}
{{--                                        <div class="border rounded">--}}
{{--                                            <div class="d-flex p-2">--}}
{{--                                                <div class="flex-shrink-0 me-3">--}}
{{--                                                    <div class="avatar-sm bg-light rounded">--}}
{{--                                                        <img data-dz-thumbnail class="img-fluid rounded d-block" src="#" alt="Product-Image" />--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="flex-grow-1">--}}
{{--                                                    <div class="pt-1">--}}
{{--                                                        <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>--}}
{{--                                                        <p class="fs-13 text-muted mb-0" data-dz-size></p>--}}
{{--                                                        <strong class="error text-danger" data-dz-errormessage></strong>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="flex-shrink-0 ms-3">--}}
{{--                                                    <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                @endif--}}
                            </ul>
                            <!-- end dropzon-preview -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Information</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div>


                                    <div class="mt-3">
                                        <label for="brand_id" class="form-label">Brand: </label>
                                        <select name="brand_id" id="brand_id" type="text" class="form-select">
                                            @foreach ($brands as $id => $name)
                                                <option value="{{ $id }}" @selected($product->brand_id === $id)>
                                                    {{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-3">
                                        <label for="category_id" class="form-label">Category:</label>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Short Description</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Add short description for product</p>
                        <textarea class="form-control" name="description" rows="3">{{ $product->description }}</textarea>
                    </div>
                    <!-- end card body -->
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Publish</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @php
                                $is = [
                                    'is_active' => 'info',
                                    'is_sale' => 'secondary',
                                    'is_show_home' => 'danger',
                                ];
                            @endphp

                            @foreach ($is as $key => $color)
                                <div class="col-md-4">
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
                    </div>
                    <!-- end card body -->
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

                                                    <td><input type="color" class="form-control form-control-color w-100" id="colorPicker" value="{{ $colorName }}" disabled></td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                            value="{{ $productVariants[$key]['quantity'] }}"
                                                            name="product_variants[{{ $key }}][quantity]">
                                                    </td>
                                                    <td>
                                                        <div class="profile-user mx-auto">
                                                            <input id="profile-img-file-input-{{ $sizeID }}-{{ $colorID }}"
                                                                   type="file"
                                                                   class="profile-img-file-input"
                                                                   data-size-id="{{ $sizeID }}"
                                                                   data-color-id="{{ $colorID }}"
                                                                   name="product_variants[{{ $key }}][image]"/>
                                                            <label for="profile-img-file-input-{{ $sizeID }}-{{ $colorID }}" class="d-block" tabindex="0">
                                                            <span class="overflow-hidden border border-dashed d-flex align-items-center justify-content-center rounded"
                                                                  style="height: 70px; width: 70px;">
                                                                <img id="dark-img-{{ $sizeID }}-{{ $colorID }}"
                                                                     src="{{ preg_match('/^(http|https):\/\//', $productVariants[$key]['image']) ? $productVariants[$key]['image'] : asset('storage/' . $productVariants[$key]['image']) }}"
                                                                     class="card-logo card-logo-dark user-profile-image img-fluid"
                                                                     alt="Image">
                                                                <img id="light-img-{{ $sizeID }}-{{ $colorID }}"
                                                                     src="{{ preg_match('/^(http|https):\/\//', $productVariants[$key]['image']) ? $productVariants[$key]['image'] : asset('storage/' . $productVariants[$key]['image']) }}"
                                                                     class="card-logo card-logo-light user-profile-image img-fluid"
                                                                     alt="Image">
                                                            </span>
                                                            </label>
                                                        </div>
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
@endsection

@section('scripts')
    <script src="{{ URL::asset('theme/admin/assets/js/pages/ecommerce-product-create.init.js') }}"></script>
    <script src="{{ URL::asset('theme/admin/assets/libs/dropzone/dropzone-min.js') }}"></script>
    <script>
        CKEDITOR.replace('content');
        const images = @json($product->galleries);
        var dropzonePreviewNode = document.querySelector("#dropzone-preview-list");
        dropzonePreviewNode.itemid = "";
        var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
        dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
        var dropzone = new Dropzone(".dropzone", {
            url: 'https://httpbin.org/post',
            method: "post",
            previewTemplate: previewTemplate,
            previewsContainer: "#dropzone-preview",

            init: function () {
                const dropzoneInstance = this;

                // Thêm hình ảnh từ mảng vào Dropzone
                images.forEach(image => {
                    // Tạo một mock file
                    const mockFile = { name: image.image };

                    // Thêm mock file vào Dropzone
                    dropzoneInstance.emit("addedfile", mockFile);
                    dropzoneInstance.emit("thumbnail", mockFile, image.image);

                    // Đặt trạng thái file là đã hoàn tất tải lên
                    dropzoneInstance.emit("complete", mockFile);

                    // Thêm các lớp CSS để hiển thị trạng thái thành công
                    mockFile.previewElement.classList.add("dz-success", "dz-complete");
                });
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Lắng nghe sự kiện thay đổi cho tất cả các input file
            document.querySelectorAll(".profile-img-file-input").forEach(function(input) {
                input.addEventListener("change", function() {
                    var sizeID = input.getAttribute("data-size-id");
                    var colorID = input.getAttribute("data-color-id");

                    // Lấy file đã chọn
                    var file = input.files[0];
                    if (file) {
                        var reader = new FileReader();

                        // Khi file được đọc xong
                        reader.onload = function(event) {
                            // Cập nhật hình ảnh Dark và Light
                            var darkImg = document.getElementById("dark-img-" + sizeID + "-" + colorID);
                            var lightImg = document.getElementById("light-img-" + sizeID + "-" + colorID);

                            // Đặt src của ảnh
                            darkImg.src = event.target.result;
                            lightImg.src = event.target.result;

                            // Thay đổi kích thước của ảnh container
                            var imageContainer = input.closest('label').querySelector('span');
                            imageContainer.style.height = '100px';
                            imageContainer.style.width = '200px';
                        };

                        // Đọc file dưới dạng URL
                        reader.readAsDataURL(file);
                    }
                });
            });
        });

        document.querySelector("#product-image-input").addEventListener("change", function () {
            console.log(1)
            var preview = document.querySelector("#product-img");
            var file = document.querySelector("#product-image-input").files[0];
            var reader = new FileReader();
            reader.addEventListener("load",function () {
                preview.src = reader.result;
            },false);
            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
