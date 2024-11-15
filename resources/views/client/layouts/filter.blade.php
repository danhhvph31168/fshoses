{{-- Menu navbar --}}
<div class="col-md-3">

    {{-- Danh sách thương hiệu --}}
    <div class="row">
        <div class="col-md-12">
            <table class="table table-nowrap border table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-bg-dark text-uppercase">Thương hiệu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brd as $item)
                        <tr>
                            <td><a href="{{ route('client.productByBrand', $item->id) }}" class="link-success">
                                    {{ $item->name }} <i class="ri-arrow-right-line align-middle"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>    
</div>
