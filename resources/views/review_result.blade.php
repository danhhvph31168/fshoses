@extends('client.layouts.master')

@section('title')
    Trang chủ
@endsection
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($rating)
    <h1>Đánh giá sản phẩm</h1>
    <p>Đánh giá của bạn: {{ $rating->value }} sao</p>
    <p>Nhận xét: {{ $rating->comment }}</p>
@else
    <p>Bạn chưa đánh giá sản phẩm này.</p>
@endif

@endsection
