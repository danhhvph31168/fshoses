@extends('admin.layouts.master')

@section('title')
    Show Rating
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Show Rating</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Tables</a></li>
                        <li class="breadcrumb-item active">Show rating</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-6">
            <h3 class="text-primary">Order</h3>
            <textarea class="form-control" cols="30" rows="6" readonly>
                - Sku Order: {{ $rating->order->sku_order }}
                - Total Amount: {{ number_format($rating->order->total_amount) }} VNĐ
                - Payment: {{ $rating->order->payment->payments_method }} 
                - Status Order: {{ $rating->order->status_order }} 
                - Status Payment: {{ $rating->order->payment->status }} 
            </textarea>
        </div>

        <div class="col-6">
            <h3 class="text-primary">Content rating</h3>
            <textarea class="form-control" cols="30" rows="6" readonly>
                - Content: {{ $rating->comment }}
                - Number of Stars: {{ $rating->value }} 
            </textarea>
        </div>

    </div>

    <div class="row mt-3 bg-white m-1 rounded border border-2">
        <div class="col-6 mt-3 pb-3">
            <h3 class="text-primary">Product</h3>
            <div class="text-center">
                <img class="rounded" width="50%" height="180px" src="{{ Storage::url($rating->product->img_thumbnail) }}"
                    alt="">
            </div>
            <div class="mt-5">
                Name : {{ $rating->product->name }}
            </div>
            <div class="mt-3">
                Sku : {{ $rating->product->sku }}
            </div>
            <div class="mt-3">
                Price Regular : {{ number_format($rating->product->price_regular) }}
            </div>
            <div class="mt-3">
                Price Sale : {{ $rating->product->price_sale }}%
            </div>
            <div class="mt-3">
                View : {{ $rating->product->views }}
            </div>
        </div>

        <div class="col-6 mt-3 pb-3">
            <h3 class="text-primary">User</h3>
            <div class="text-center mb-3">
                <img class="rounded-circle" width="180px" height="180px" src="{{ Storage::url($rating->user->avatar) }}"
                    alt="">
            </div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-5">
                    <div class="mt-3">
                        Name : {{ $rating->user->name }}
                    </div>
                    <div class="mt-3">
                        Role : {{ $rating->user->role->name }}
                    </div>
                    <div class="mt-3">
                        Email : {{ $rating->user->email }}
                    </div>
                    <div class="mt-3">
                        Phone : {{ $rating->user->phone }}
                    </div>
                </div>

                <div class="col-5">
                    <div class="mt-3">
                        Address : {{ $rating->user->address }}
                    </div>
                    <div class="mt-3">
                        District : {{ $rating->user->district }}
                    </div>
                    <div class="mt-3">
                        Province : {{ $rating->user->province }}
                    </div>
                    <div class="mt-3">
                        Created At : {{ $rating->user->created_at->format('d/m/y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    {{-- <script src="{{ asset('theme/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        })
    </script>
@endsection
