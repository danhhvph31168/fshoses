@extends('client.layouts.master')

@section('content')
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

    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{ route('addOrder') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <h6 class="checkout__title">Payment Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Full Name<span>*</span></p>
                                        <input class="@error('user_name') is-invalid @enderror" type="text"
                                            name="user_name" value="{{ auth()->user()?->name }}">
                                        @error('user_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input class="@error('user_email') is-invalid @enderror" type="text"
                                            name="user_email" value="{{ auth()->user()?->email }}">
                                        @error('user_email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input class="@error('user_phone') is-invalid @enderror" type="text"
                                            name="user_phone" value="{{ auth()->user()?->phone }}">
                                        @error('user_phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Address<span>*</span></p>
                                        <input class="@error('user_address') is-invalid @enderror" type="text"
                                            name="user_address" value="{{ auth()->user()?->address }}">
                                        @error('user_address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Note<span>*</span></p>
                                <textarea class="form-control" name="user_note" cols="30" rows="3"></textarea>
                            </div>

                            <div class="mt-4">
                                <h5 class="font-weight-bold">Payment Method</h5>
                                <p class="text-muted">Choose the payment method that best suits you</p>

                                <div class="card mb-4">
                                    <div class="card-body py-2" style="padding-left: 35px">
                                        <input role="button"
                                            class="form-check-input @error('payment_method') is-invalid @enderror"
                                            type="radio" name="payment_method" id="cod"
                                            value="{{ App\Models\Payment::PAYMENTS_METHOD_CASH }}" checked>
                                        <label class="form-check-label ms-1" for="cod">
                                            <strong role="button">Cash (COD)</strong>
                                        </label>
                                        <small class="form-text text-muted ms-1">Use cash to pay upon receipt</small>
                                    </div>
                                    @error('payment_method')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="card mb-4">
                                    <div class="card-body py-2" style="padding-left: 35px">
                                        <input role="button"
                                            class="form-check-input @error('payment_method') is-invalid @enderror"
                                            type="radio" name="payment_method" id="vnpay"
                                            value="{{ App\Models\Payment::PAYMENTS_METHOD_VNPAY }}">
                                        <label class="form-check-label ms-1" for="vnpay">
                                            <strong role="button">VNPay e-wallet</strong>
                                        </label>
                                        <small class="form-text text-muted ms-1">You will proceed to pay by VNPAY in the
                                            next step</small>
                                    </div>
                                    @error('payment_method')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your product</h4>
                                <div class="checkout__order__products">Product information</div>

                                @foreach ($cart as $item)
                                    <ul class="checkout__total__products d-flex">
                                        <li style="margin-right: 10px">
                                            @if (!\Str::contains($item['img_thumbnail'], 'http'))
                                                <img src="{{ \Storage::url($item['img_thumbnail']) }}" width="100px"
                                                    height="100px">
                                            @else
                                                <img src="{{ $item['img_thumbnail'] }}" width="100px" height="100px">
                                            @endif
                                        </li>

                                        <li>{{ \Str::limit($item['name'], 30) }}
                                            <br>Price: <span>{{ number_format($item['price_sale']) }}</span>
                                            <br>Quantity: <span> {{ $item['quatity'] }}</span>
                                            <br>Total Amount:
                                            <span>{{ number_format($item['quatity'] * $item['price_sale']) }}</span>
                                        </li>
                                    </ul>
                                @endforeach

                                <ul class="checkout__total__all">
                                    <li>Total <span>{{ number_format($totalAmount) }} VNĐ</span></li>
                                </ul>

                                <input type="hidden" name="totalAmount" value="{{ $totalAmount }}">

                                <button type="submit" name="redirect" class="site-btn">Pay</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
