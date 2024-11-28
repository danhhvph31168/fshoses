@extends('client.layouts.checkout.checkout')


@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="/" style="opacity: 50%">Home</a>
                            <a href="{{ route('cart.list') }}" style="opacity: 50%">Shop</a>
                            <strong style="font-weight: 600; !important">Check Out</strong>
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
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                        <p>Province<span>*</span></p>
                                        <select class="@error('user_province') is-invalid @enderror form-control w-100"
                                            name="user_province" id="province">
                                            <option value="{{ auth()->user()?->province }}">
                                                {{ auth()->user()?->province }}
                                            </option>
                                        </select>
                                        <input type="hidden" name="provinceText" id="provinceText">
                                        @error('user_province')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                        <p>District<span>*</span></p>
                                        <select class="@error('user_district') is-invalid @enderror form-control w-100"
                                            name="user_district" id="district">
                                            <option value="{{ auth()->user()?->district }}">
                                                {{ auth()->user()?->district }}</option>
                                        </select>
                                        <input type="hidden" name="districtText" id="districtText">
                                        @error('user_district')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                        <p>Ward<span>*</span></p>
                                        <select class="@error('user_ward') is-invalid @enderror form-control w-100"
                                            name="user_ward" id="ward">
                                            <option value="{{ auth()->user()?->ward }}">{{ auth()->user()?->ward }}
                                            </option>
                                        </select>
                                        <input type="hidden" name="wardText" id="wardText">
                                        @error('user_ward')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                            <div class="checkout__input mt-4">
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
                                    <ul class="checkout__total__products">
                                        <td class="product__cart__item">
                                            <div class="row">
                                                <div class="product__cart__item__pic col-md-4">
                                                    @if (!\Str::contains($item['img_thumbnail'], 'http'))
                                                        <img src="{{ \Storage::url($item['img_thumbnail']) }}"
                                                            width="100px" height="100px">
                                                    @else
                                                        <img src="{{ $item['img_thumbnail'] }}" width="100px"
                                                            height="100px">
                                                    @endif
                                                </div>
                                                <div class="product__cart__item__text pt-0 col-md-8">
                                                    <div class=" fs-5 fw-bold">
                                                        {{ $item['name'] }}
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="product_color"
                                                            value="{{ $item['color']['id'] }}"
                                                            id="color-{{ $item['color']['id'] }}" class="color-radio"
                                                            style="display: none;">
                                                    </div>
                                                    <div class=" d-flex fs-6">
                                                        Size: {{ $item['size']['name'] }} -
                                                        <div class="d-flex ms-2">
                                                            Color:<label class="ms-3"
                                                                for="color-{{ $item['color']['id'] }} }}"
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
                                                    <div class="">
                                                        <label for=""class="fs-6">Quantity: </label>
                                                        <span class="ms-2"> {{ $item['quatity'] }}</span>
                                                    </div>
                                                    @php
                                                        $price =
                                                            $item['price_regular'] *
                                                            ((100 - $item['price_sale']) / 100);
                                                    @endphp

                                                    <h5 class="price_sale text-danger"
                                                        data-price_sale="{{ number_format($price) }}">
                                                        {{ number_format($price) }} VNĐ
                                                    </h5>
                                                </div>
                                            </div>
                                        </td>
                                    </ul>
                                @endforeach
                                @php
                                    $shippingCharge = $totalAmount < 1000000 ? 50000 : 0;
                                    $total = $totalAmount + $shippingCharge;
                                @endphp

                                <ul class="checkout__total__all">
                                    <li>Sub Total :<span>{{ number_format($totalAmount) }} VNĐ</span></li>
                                    <li>Shipping Charge :<span>{{ number_format($shippingCharge) }} VNĐ</span></li>
                                    <li>Total :<span>{{ number_format($total) }} VNĐ</span></li>
                                </ul>

                                <input type="hidden" name="totalAmount" value="{{ $total }}">

                                <button type="submit" name="redirect" id="submit" class="site-btn">Pay</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"
        integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const host = "https://provinces.open-api.vn/api/";
        var callAPI = (api) => {
            let row = `<option value="">{{ auth()->user()?->province ? auth()->user()?->province : 'Chọn' }}</option>`;
            return axios.get(api)
                .then((response) => {
                    // const a = auth()->user()?->province
                    // const data = response.data.filter(item => item !== a);
                    // console.log(response.data)
                    renderData(response.data, "province", row);
                });
        }
        callAPI('https://provinces.open-api.vn/api/?depth=1');
        let row = `<option  value="">Chọn</option>`;
        var callApiDistrict = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.districts, "district", row);
                });
        }
        var callApiWard = (api) => {
            let row = `<option  value="">Chọn</option>`;
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.wards, "ward", row);
                });
        }

        var renderData = (array, select, row) => {
            array.forEach(element => {
                row += `<option value="${element.code}">${element.name}</option>`
            });
            document.querySelector("#" + select).innerHTML = row
        }

        $("#province").change(() => {
            callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
            printResult();
        });
        $("#district").change(() => {
            callApiWard(host + "d/" + $("#district").val() + "?depth=2");
            printResult();
        });
        $("#ward").change(() => {
            printResult();
        })


        var printResult = () => {
            if ($("#district").val() != "" && $("#province").val() != "" &&
                $("#ward").val() != "") {
                let result = $("#province option:selected").text() +
                    " | " + $("#district option:selected").text() + " | " +
                    $("#ward option:selected").text();
                $("#result").text(result)
            }


            $('#submit').click(function() {
                $('#provinceText').val($('#province option:selected').text());
                $('#districtText').val($('#district option:selected').text());
                $('#wardText').val($('#ward option:selected').text());
            })
        }
    </script>
@endsection
