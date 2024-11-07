@extends('client.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart->list() as $key => $value) @dd($value)
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                {{-- Kiểm tra hình ảnh nếu cần --}}
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6>{{ $value['name'] ?? 'Tên sản phẩm không có' }}</h6>
                                                <h5>{{ number_format($value['price'] ?? 0) }}</h5>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <form action="">
                                                @csrf
                                                <div class="quantity">
                                                    <div class="pro-qty-2">
                                                        <input class="quantity-input" type="text"
                                                            value="{{ $value['quantity'] ?? 1 }}"
                                                            data-id="{{ $value['id'] }}">
                                                    </div>
                                                </div>
                                            </form>

                                        </td>

                                        <td class="cart__price cart-price-{{ $value['id'] }}">
                                            {{ number_format(($value['price'] ?? 0) * ($value['quantity'] ?? 1)) }}
                                        </td>
                                        <td class="cart__close">
                                            <a onclick="return confirm('Bạn muốn xóa không')"
                                                href="{{ route('cart.delete', $value['id']) }}"><i class="fa fa-close">
                                                </i></a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    @if (isset($value['id']))
                        <div class="cart__total">
                            <ul>
                                <li>Subtotal<span class="cart__total-price cart-price-{{ $value['id'] }}">
                                        {{-- {{ number_format($cart->getTotalPrice()) }} --}}
                                    </span></li>
                                <li>
                                    Total<span class="cart__total-price cart-price-{{ $value['id'] }}">
                                        {{-- {{ number_format($cart->getTotalPrice()) }} --}}
                                    </span>
                                </li>
                            </ul>
                            <h6></h6>
                            <a href="{{ route('checkout.form') }}" class="primary-btn">Proceed to checkout</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Shopping Cart Section End -->


    <script src="{{ asset('theme/client/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('theme/client/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/main.js') }}"></script>
    <script src="{{ asset('theme/client/js/ajaxUpdateCart.js') }}"></script>
@endsection
</body>

</html>
