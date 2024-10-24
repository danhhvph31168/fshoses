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
    <title>Home</title>
</head>

<body>
    <div class="container m-4">
        <h1>Đây là trang chu</h1>
        @if (!Auth::check())
            <a href="{{ route('auth.showFormRegister') }}" class="btn btn-primary">Đăng ký</a>
            <a href="{{ route('auth.showFormLogin') }}" class="btn btn-success">Đăng nhập</a>
        @endif
        @if (Auth::check())
            @if (Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="btn btn-success">Trang Admin</a>
            @elseif (Auth::user()->isEmployee())
                <a href="{{ route('admin.dashboard') }}" class="btn btn-success">Trang Employee</a>
            @endif

            <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Hi {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('showFormUpdateProfile', Auth::user()->id) }}">Cập nhật
                            thông tin tài khoản</a></li>
                    <li><a class="dropdown-item" href="{{ route('showFormChangePassword') }}">Change Password</a></li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                </ul>
            </div>
        @endif
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 col-lg-3 mb-4">
                    <div class="card m-4" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <h6 class="card-title">{{ $product->category->name }}</h6>
                            <h5 class="card-title">{{ $product->price }}</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the
                                card's
                                content.</p>
                            <a href="{{ route('productDetail', $product->id) }}" class="btn btn-primary">Xem chi tiet</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    {{ $products->links() }}
</body>

</html>