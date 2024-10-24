<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    <title>Chi tiết sản phẩm</title>
</head>

<body>

    <div class="container">
        <h1>Chi tiết sản phẩm : {{$product->name}}</h1>
        <!-- <h5>Hình ảnh galleries</h5>
        <div class="product-gallery">
                @foreach($product->galleries as $gallery)
                    <div class="col-md-3 mb-3">
                        <img src="{{ $gallery->image }}" class="img-thumbnail" alt="Product Image">
                    </div>
                @endforeach
        </div> -->

        <div class="card m-4" style="width: 18rem;">
            <h5>Hình ảnh sản phẩm</h5>

            <div class="product-gallery">
      
                    <div class="col-md-5 mb-4">
                        <img src="{{ $product->galleries->first()->image }}" class="img-thumbnail" alt="Product Image" width="200px"
                            height="200px">
                    </div>

            </div>
            <div class="card-body">
                <h5 class="card-title">{{$product->name}}</h5>
                <h6 class="card-title">{{$product->category->name}}</h6>

                <del class="card-title">{{$product->price_regular}}</del>
                <h6 class="card-title">{{$product->price_sale}}</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's
                    content.</p>
                <h6 class="card-title">Chọn màu sắc</h6>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    @foreach ($colors as $color_id => $color_name)
                        <option value="{{$color_id}}"> {{$color_name}} </option>
                    @endforeach
                </select>
                <h6 class="card-title mt-3">Chọn Size</h6>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    @foreach ($sizes as $size_id => $size_name)
                        <option value="{{$size_id}}"> {{$size_name}} </option>
                    @endforeach
                </select>
                <a href="#" class="btn btn-success mt-4 mb-4">Mua hàng</a>
                <a href="#" class="btn btn-primary">Thêm vào giỏ hàng</a>
            </div>
        </div>
        <form>

            <div class="mb-3 position-relative">
                <label for="exampleFormControlTextarea1" class="form-label">Viet binh luan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

                <div class="position-absolute" style="right: 0; bottom: -50px;">
                    <a href="" class="btn btn-info">Sửa</a>
                    <a href="" class="btn btn-danger">Xóa</a>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Gui</button>
        </form>
    </div>

</body>

</html>