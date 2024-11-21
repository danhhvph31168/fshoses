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
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Shopping Cart</span>
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
                            <tr class="product">
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        @if (!\Str::contains($item['img_thumbnail'], 'http'))
                                        <img src="{{ \Storage::url($item['img_thumbnail']) }}" width="100px"
                                            height="100px">
                                        @else
                                        <img src="{{ $item['img_thumbnail'] }}" width="100px" height="100px">
                                        @endif
                                    </div>
                                    <div class="product__cart__item__text">
                                        <a href="">
                                            <h6>{{ $item['name'] }}</h6>
                                        </a>
                                        <h5 class="price_sale"
                                            data-price_sale="{{ number_format($item['price_sale']) }}">$
                                            {{ number_format($item['price_sale']) }}
                                            <del
                                                class="badge text-secondary">{{ number_format($item['price_regular']) }}</del>
                                        </h5>
                                    </div>
                                </td>
                                <td class="quantity__item">
                                    <form action="{{ route('cart.update') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="variant_id" value="{{ $key }}">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="number" id="quatity" name="quatity" class="quatity-input"
                                                    value="{{ $item['quatity'] }}" data-id="{{ $key }}">
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td class="cart__price cart-price-{{ $key }} ">$
                                    <span
                                        class="price">{{ number_format($item['quatity'] * $item['price_sale']) }}</span>
                                </td>
                                <td class="cart__close">
                                    <form action="{{ route('cart.delItem', $key) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')"
                                            class="border-0 rounded-circle w-100 p-1"><b>x</b></button>
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
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <button type="submit">Apply</button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal : <span class="cart-price total">{{ number_format($totalAmount) }}
                                VNĐ</span></li>
                        <li>Total : <span class="cart-price total">{{ number_format($totalAmount) }}
                                VNĐ</span></li>
                    </ul>
                    <a href="{{ route('check-out') }}" class="primary-btn">Purchase</a>
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
        const price_sale = parseInt(price_sale_raw.replace(/,/g, ''), 10)

        const price_element = $(this).find('.price')

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
                    quatity: value_input
                },
                dataType: "json",
                success: function(response) {
                    const total_raw = Math.floor(response.data.totalCart)

                    $('.total').text(formatter.format(total_raw) + ' VNĐ')
                },
            });

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