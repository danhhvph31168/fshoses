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
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <title>Home</title>
</head>

<body>
    <div class="container m-4">
        <h1>Đây là trang chủ</h1>
    </div>
    <form action="{{route('cart.add')}}" method="post">
        @csrf
        @foreach ($products as $product)
        <input type="hidden" name="id" value="{{$product->id }}">
        <div class="card m-4" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$product->id}}</h5>
                <h5 class="card-title">{{ $product->name }}</h5>
                <h6 class="card-title">{{ $product->category->name }}</h6>
                <h5 class="card-title">{{ $product->price }}</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's
                    content.</p>
                <button type="submit" class="btn btn-primary">
                    Add To Cart
                </button>
                {{-- <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary">addToCart</a> --}}
                <a href="{{ route('productDetail', ['id' => $product->id]) }}" class="btn btn-primary">Xem chi tiết</a>

            </div>
        </div>

        @endforeach
    </form>
    </div>
</body>

</html>
