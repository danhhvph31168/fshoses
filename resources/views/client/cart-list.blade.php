@extends('client.layouts.master')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="/" style="opacity: 50%">Home</a>
                            <a href="{{ route('cart.list') }}" style="opacity: 50%">Shop</a>
                            <strong style="font-weight: 600; !important">Shopping Cart</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                                    <th>Total amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="cart">
                                @if (session()->has('cart'))
                                    @foreach ($cart as $key => $item)
                                        @php
                                            $price = $item['price_regular'] * ((100 - $item['price_sale']) / 100);
                                        @endphp
                                        <tr class="product">
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    @if (!\Str::contains($item['img_thumbnail'], 'http'))
                                                        <img src="{{ \Storage::url($item['img_thumbnail']) }}"
                                                            width="100px" height="100px">
                                                    @else
                                                        <img src="{{ $item['img_thumbnail'] }}" width="100px"
                                                            height="100px">
                                                    @endif
                                                </div>
                                                <div class="product__cart__item__text pt-0">
                                                    <div class="mb-2 fs-6 fw-bold">
                                                        {{ $item['name'] }}
                                                    </div>
                                                    @foreach ($colors as $id => $color)
                                                        <div>
                                                            <input type="radio" name="product_color"
                                                                value="{{ $id }}" id="color-{{ $id }}"
                                                                class="color-radio" style="display: none;">
                                                        </div>
                                                    @endforeach
                                                    <div class="mb-3 d-flex">
                                                        Size: {{ $item['size']['name'] }} -
                                                        <div class="d-flex ms-2">
                                                            Color:<label class="ms-3" for="color-{{ $id }}"
                                                                style="
                                                                    width: 20px;
                                                                    height: 20px;
                                                                    border: 2px solid #ccc;
                                                                    background-color: {{ $item['color']['name'] }};
                                                                    display: inline-block;
                                                                    cursor: pointer;
                                                                    transition: border-color 0.3s;
                                                                ">
                                                            </label>
                                                        </div>

                                                    </div>

                                                    <h5 class="price_sale text-danger"
                                                        data-price_sale="{{ number_format($price) }}">
                                                        {{ number_format($price) }} VNĐ
                                                        <del class="badge text-secondary">{{ number_format($item['price_regular']) }}
                                                            VNĐ</del>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <form action="{{ route('cart.update') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="variant_id" value="{{ $key }}">
                                                    <div class="quantity">
                                                        <div class="pro-qty-2">
                                                            <input type="number" id="quatity" name="quatity"
                                                                class="quantity-input" value="{{ $item['quatity'] }}"
                                                                data-id="{{ $key }}">
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="cart__price cart-price-{{ $key }} ">
                                                <span class="price">{{ number_format($item['quatity'] * $price) }}
                                                </span>VNĐ
                                            </td>
                                            <td class="cart__close">
                                                <form action="{{ route('cart.delItem', $key) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you sure?')"
                                                        class="border-0 bg-white ms-3"><i
                                                            class="fa-solid fa-xmark text-danger"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('client.home') }}">Continue shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a onclick="return confirm('Are you sure you want to clear your cart?')"
                                    href="{{ route('cart.delete') }}"><i class="fa fa-spinner"></i>Clear all</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="{{ route('cart.applyCoupon') }}" method="post">
                            @csrf
                            <input type="text" placeholder="Coupon code" name="code">
                            <button type="submit">Apply</button>
                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger bg-white border-0 ">
                                @foreach ($errors->all() as $error)
                                    <strong class="text-danger">{{ $error }}</strong>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="cart__total">
                        {{-- <h6>Giỏ hàng tổng cộng</h6> --}}
                        {{-- Thông báo thành công nếu có --}}
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if (session('coupon'))
                            <ul>
                                @if (session('coupon.type') === 'fixed')
                                    <li>Discount ({{ session('coupon.code') }}): <span
                                            class="cart-price discount">{{ number_format(session('coupon.value')) }}
                                            VNĐ </span></li>
                                @else
                                    <li>Discount ({{ session('coupon.code') }}): <span
                                            class="cart-price discount">{{ session('coupon.value') }} %</span>
                                    </li>
                                @endif
                                <li>Total: <span class="cart-price total">{{ number_format($totalAmount) }} VNĐ</span>
                                </li>
                            </ul>
                        @else
                            <ul>
                                <li>Subtotal: <span class="cart-price total">{{ number_format($totalAmount) }} VNĐ</span>
                                </li>
                                <li>Total: <span class="cart-price total">{{ number_format($totalAmount) }} VNĐ</span>
                                </li>
                            </ul>
                        @endif
                        <a href="{{ route('check-out') }}" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#quatity').on('input', function() {
                if ($(this).val() < 1) {
                    $(this).val(1);
                }
            });

            var formatter = new Intl.NumberFormat('en-US'); // Chỉ định ngôn ngữ và khu vực (US)

            $('.product').each(function() {

                const price_sale_raw = $(this).find('.price_sale').data('price_sale');

                const discount = $(this).find('.discount').data('discount');

                const price_sale = parseInt(price_sale_raw.replace(/,/g, ''), 10);

                const price_element = $(this).find('.price');

                $(this).find('input').on('change', function() {
                    const value_input = $(this).val();
                    console.log('Input đã thay đổi:', this.value);

                    const dataId = $(this).data('id');
                    console.log('id đã thay đổi:', dataId);

                    price_element.text(formatter.format(price_sale * value_input));

                    $.ajax({
                        type: "get",
                        url: `{{ route('cart.update') }}`,
                        headers: {
                            'X-CSRF-TOKEN': `{{ csrf_token() }}`
                        },
                        data: {
                            variant_id: dataId,
                            quatity: value_input,
                            discount: discount
                        },
                        dataType: "json",
                        success: function(response) {

                            console.log(response);

                            const total_raw = Math.floor(response.data.totalCart)

                            $('.total').text(formatter.format(total_raw) + ' VNĐ')
                        },
                        error: function(xhr, status, error) {
                            console.error("Error: " + error);
                        }
                    });

                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const colorRadios = document.querySelectorAll('.color-radio');

            colorRadios.forEach((radio) => {
                radio.addEventListener('change', function() {
                    // Bỏ màu tối cho tất cả các label
                    colorRadios.forEach((input) => {
                        const label = document.querySelector(`label[for="${input.id}"]`);
                        label.style.borderColor = '#ccc'; // Khôi phục viền màu gốc
                        label.style.boxShadow = 'none'; // Bỏ hiệu ứng tối
                    });

                    // Làm tối màu cho label của radio được chọn
                    const selectedLabel = document.querySelector(`label[for="${this.id}"]`);
                    selectedLabel.style.borderColor = '#000'; // Viền màu đen
                    selectedLabel.style.boxShadow =
                        '0 0 5px rgba(0, 0, 0, 0.5)'; // Thêm hiệu ứng tối
                });
            });
        });
    </script>
@endsection

@section('css')
    <style>
        .breadcrumb__links::after {
            content: none;
        }
    </style>
@endsection
