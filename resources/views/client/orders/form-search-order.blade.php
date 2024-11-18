@extends('client.layouts.master')

@section('title')
Tra cứu đơn hàng
@endsection

@section('content')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Order Tracking</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ route('client.home') }}">Home</a>
                        <span>Order Tracking</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="container mt-4 mb-5">
    <form class="w-50" action="{{ route('handleSearchOrder') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Order Code</label>
            <input type="text" class="form-control @error('sku_order') is-invalid @enderror" id="sku_order"
                name="sku_order" placeholder="Enter order code..." autofocus value="{{ old('sku_order') }}">
            @error('sku_order')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="exampleInputPassword1" class="form-label fw-bold">Phone</label>
            <input type="text" name="user_phone" class="form-control @error('user_phone') is-invalid @enderror"
                id="exampleInputPassword1" placeholder="Enter phone..." value="{{ old('user_phone') }}">
            @error('user_phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-danger mt-2">Search</button>
    </form>
</div>
@endsection