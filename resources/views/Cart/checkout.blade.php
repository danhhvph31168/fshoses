@extends('client.layouts.master')

@section('title')
Thanh toán
@endsection

@section('content')
<!-- Hero Section Begin -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('client.layouts.header')

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">Sign in</a>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="img/icon/heart.png" alt=""></a>
            <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code">
                                <span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter
                                your code
                            </h6>
                            <h6 class="checkout__title">Billing Details</h6>

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Tên người nhận<span>*</span></p>
                                        <input type="text" name="last_name" value="{{ $user->name ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address_line1" placeholder="District and Province"
                                    value="{{ $user->district ?? '' }} {{ $user->province ?? '' }}">
                                <input type="text" name="address_line2" placeholder="Full Address"
                                    value="{{ $user->address ?? '' }}">
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text" name="state" value="Việt Nam">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="zip_code" value="{{ $user->zip_code ?? '' }}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone" value="{{ $user->phone ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email" value="{{ $user->email ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Note about your order, e.g, special note for delivery
                                    <input type="checkbox" id="diff-acc" name="special_note">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text" name="user_note"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product <span>Total</span></div>
                                <ul class="checkout__total__products">
                                    @foreach ($cart->list() as $key => $value)
                                    <li>{{ $value['name'] ?? 'Tên sản phẩm không có' }}<span>{{
                                            number_format($value['price'] ?? 0)
                                            }}</span></li>
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Total <span>{{ number_format($cart->getTotalPrice()) }}</span></li>
                                </ul>
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore
                                    et dolore magna aliqua.</p>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment" name="payment_method" value="check">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal" name="payment_method" value="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
    <!-- Footer Section End -->
    <!-- Js Plugins -->
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
</body>

</html>
