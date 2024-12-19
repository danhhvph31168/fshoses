@extends('client.layouts.checkout.checkout')
<style>
    .checkout__order {
        padding: 20px !important;
    }

    .spad {
        padding-top: 50px !important;
    }
</style>

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
                <div class="row">
                    <div class="col-lg-7 col-md-12 align-content-center">
                        <h4 class="">PAYMENT DETAILS</h4>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <form action="{{ route('cart.applyCoupon') }}" method="post">
                            @csrf
                            <div class="checkout__order input-group">
                                <select class="select-group border border-primary rounded" name="code"
                                    style="width:375px;">
                                    <option value="">Select Coupon</option>
                                    @foreach ($coupons as $coupon)
                                        <option value="{{ $coupon->code }}">{{ $coupon->code }} -
                                            {{ number_format($coupon->value, 0, ',', '.') }}
                                            @php
                                                if ($coupon->type == 'percent') {
                                                    $pt = ' %';
                                                    echo '%';
                                                } else {
                                                    $pt = ' VNĐ';
                                                    echo 'VNĐ';
                                                }
                                            @endphp

                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-dark rounded px-4 ms-2">Apply</button>
                            </div>
                        </form>

                        <div class="checkout__order input-group py-0 pt-3" >
                            @if (session('coupon'))
                                <input class="form-control ps-2 bg-white border border-primary rounded" type="text"
                                    value="{{ session('coupon')['type'] == 'percent' ? session('coupon')['code'] . ' - ' . session('coupon')['value'] . ' %' : session('coupon')['code'] . ' - ' . number_format(session('coupon')['value']) . ' VDN' }}"
                                     readonly>
                                <button style="padding: 0 42px" id="remove-coupon-btn"
                                    class="btn btn-danger rounded ms-2">X</button>
                            @endif
                        </div>

                    </div>
                </div>
                <form action="{{ route('addOrder') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
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
                                        <input type="hidden" name="provinceText" id="provinceText"
                                            value="{{ auth()->user()?->province }}">
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
                                        <input type="hidden" name="districtText" id="districtText"
                                            value="{{ auth()->user()?->district }}">
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
                                        <input type="hidden" name="wardText" id="wardText"
                                            value="{{ auth()->user()?->ward }}">
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
                                @php
                                    $totalAmount = 0;
                                @endphp
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
                                    @php
                                        $sub = $item['quatity'] * $price;
                                        $totalAmount += $sub;
                                    @endphp
                                @endforeach

                                @php
                                    $shippingCharge = $totalAmount < 1000000 ? 50000 : 0;
                                @endphp

                                @if (session('coupon'))
                                    <ul class="checkout__total__all">
                                        <li>Sub Total :<span>{{ number_format($totalAmount) }} VNĐ</span></li>
                                        @php
                                            $discount = session('coupon')['value'];
                                        @endphp
                                        @if (session('coupon.type') === 'percent')
                                            <li>Discount ({{ session('coupon.code') }}): <span
                                                    class="cart-price discount">{{ number_format(session('coupon.value')) }}
                                                    % </span></li>

                                            @php
                                                $total = $totalAmount * ((100 - $discount) / 100) + $shippingCharge;
                                            @endphp
                                        @else
                                            <li>Discount ({{ session('coupon.code') }}): <span
                                                    class="cart-price discount">{{ number_format(session('coupon.value')) }}
                                                    VNĐ</span>
                                            </li>
                                            @php
                                                $total = $totalAmount - $discount + $shippingCharge;
                                            @endphp
                                        @endif


                                        <li>Shipping Charge :<span>{{ number_format($shippingCharge) }} VNĐ</span></li>
                                        <li>Total :<span>{{ number_format($total) }} VNĐ</span></li>
                                    </ul>
                                @else
                                    <ul class="checkout__total__all">
                                        @php
                                            $total = $totalAmount + $shippingCharge;
                                        @endphp
                                        <li>Sub Total :<span>{{ number_format($totalAmount) }} VNĐ</span></li>
                                        <li>Shipping Charge :<span>{{ number_format($shippingCharge) }} VNĐ</span></li>
                                        <li>Total :<span>{{ number_format($total) }} VNĐ</span></li>
                                    </ul>
                                @endif

                                <input type="hidden" name="totalAmount" value="{{ $total }}">

                                {{-- <button type="submit" name="redirect" id="submit" class="site-btn">Pay</button> --}}

                                <!-- Button trigger modal -->
                                <button type="button" class="site-btn" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Pay
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel"><a
                                                        class="text-primary" href="{{ route('policy') }}"
                                                        target="_blank">Terms of use </a></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <textarea name="" id="" rows="15" class="form-control" readonly>
1. QUY ĐỊNH MUA HÀNG:
    - Khi mua hàng tại Fshoes khách hàng có thể mua tối đa 05 sản phẩm cùng loại trên 01 đơn hàng.
    - Đối với những đơn hàng có giá trị trên 5.000.000 VND (Năm triệu đồng), Fshoes sẽ liên hệ với khách hàng qua số hotline: 1800 5678 để xác 
       nhận và khách hàng vui lòng thanh toán 100% giá trị đơn hàng qua số tài khoản:
    - Ngân hàng thương mại cổ phần kỹ thương Việt Nam - Techcombank
    - Số tài khoản: 0981208891
    - Chủ tài khoản: Công ty trách nhiệm hữu hạn Fshoes
    - Sau khi xác nhận là khách hàng đã thanh toán Fshoes sẽ giao hàng cho khách hàng trong thời gian sớm nhất.

2. QUY ĐỊNH ĐỔI TRẢ:
    - Thời hạn đổi sản phẩm là 03 ngày, tính từ ngày nhận được hàng.
    - Sản phẩm đổi phải còn mới, còn nguyên tem, hộp, nhãn mác và chưa có dấu hiệu đã sử dụng, đã giặt tẩy, bám bẩn hay biến dạng.
    - Fshoes sẽ không áp dụng việc đổi hàng với các sản phẩm đang áp dụng chương trình Sale Off từ 40% trở lên, các sản phẩm thuộc phiên bản giới 
       hạn (limited edition).
    - Tuỳ theo chương trình khuyến mãi, sẽ có thể áp dụng chính sách đổi hàng theo quy định riêng theo từng kênh.
    - Việc đổi hàng chỉ áp dụng tại đúng kênh (cửa hàng) mà bạn đã mua hàng.
    - Không áp dụng việc trả hàng – hoàn tiền trong bất cứ trường hợp nào. Mong bạn thông cảm.
    - Fshoes ưu tiên hỗ trợ đổi size, đổi màu sắc khác cùng loại. Hoặc trong trường hợp mong muốn đổi sang 01 sản phẩm khác, tôi vẫn hỗ trợ bạn:
        + Nếu bạn muốn đổi sang sản phẩm có giá trị cao hơn, bạn sẽ cần bù khoản chênh lệch tại thời điểm đổi (nếu có).
        + Nếu bạn muốn đổi sang sản phẩm có giá trị thấp hơn, chúng tôi sẽ không hoàn lại tiền.

3. QUY ĐỊNH BẢO HÀNH:
    - Đối với các sản phẩm giày, Fshoes hỗ trợ bảo hành trong vòng 06 tháng kể từ ngày mua với các trường hợp bung keo, sứt chỉ, gãy đế hoặc 1 đổi 1 
       với trường hợp phát sinh lỗi từ trong quá trình sản xuất.
    - Để việc bảo hành thuận tiện và nhanh chóng hơn, bạn vui lòng vệ sinh giày sạch sẽ trước khi gửi về Fshoes. Chúng tôi xin từ chối thực hiện việc 
       bảo hành nếu như sản phẩm chưa được vệ sinh khi nhận được giày.
                                                </textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Do not agree</button>
                                                <button name="redirect" type="submit" id="submit" class="btn btn-primary">Agree &
                                                    Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
            let row =
                `<option value="{{ auth()->user()?->province ? auth()->user()?->province : '' }}">{{ auth()->user()?->province ? auth()->user()?->province : 'Select' }}</option>`;
            return axios.get(api)
                .then((response) => {
                    renderData(response.data, "province", row);
                });
        }
        callAPI('https://provinces.open-api.vn/api/?depth=1');
        let row = `<option  value="">Select</option>`;
        var callApiDistrict = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.districts, "district", row);
                });
        }
        var callApiWard = (api) => {
            let row = `<option  value="">Select</option>`;
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

    <script>
        document.getElementById('remove-coupon-btn').addEventListener('click', function() {
            fetch('{{ route('removeCoupon') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
