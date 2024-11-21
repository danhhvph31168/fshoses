@extends('client.layouts.master')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="card text-center shadow-lg border-0 rounded-4">
            <div class="card-body">
                <h1 class="success-icon"><i class="bi bi-check-circle"></i></h1>
                <h2 class="card-title">Order successful!</h2>
                <p class="card-text fs-5">
                    Thank you for placing an order with us. Your order number is:
                 
                    <a href="{{ route('getDetailOrderItem', $order->sku_order) }}"
                        style="color: #e53637" class="fw-bold">{{ $order->sku_order }}</a>
                    
                </p>
                <p class="card-text fs-6">
                    We will contact you as soon as possible to confirm your order and delivery time.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="" class="btn btn-primary btn-lg">Continue Shopping</a>
                    <a href="{{ route('getDetailOrderItem', $order->sku_order) }}"
                        class="btn btn-outline-primary btn-lg">View My Order</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        body {
            background-color: #f6f6f2;
            color: #333;
        }

        .success-icon {
            font-size: 80px;
            color: #00ff4c;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 10px #00ff37, 0 0 20px #ce5ffa, 0 0 30px #ce5ffa, 0 0 40px #ce5ffa;
            }

            to {
                text-shadow: 0 0 20px #56ffb0, 0 0 30px #a4ff89, 0 0 40px #93ff7e, 0 0 50px #8bff7c;
            }
        }

        .card {
            background-color: #fdfdfb;
            border-color: #ddd;
        }

        .btn-primary,
        .btn-outline-primary {
            background-color: #919191;
            border-color: #919191;
            color: #fff;
        }

        .btn-outline-primary {
            color: #919191;
            background-color: transparent;
        }

        .btn-primary:hover,
        .btn-outline-primary:hover {
            background-color: #ffffff;
            border-color: #919191;
            color: #5f5e5e;
        }
    </style>
@endsection
