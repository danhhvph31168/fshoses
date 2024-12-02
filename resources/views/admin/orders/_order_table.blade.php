@foreach ($data as $item)
<tr>
    <td>{{ $item->sku_order }}</td>
    <td>{{ $item->user->name }}</td>
    <td>{{ $item->status_order }}</td>
    <td>{{ $item->status_payment }}</td>
    <td>{{ $item->total_amount }}</td>
    {{-- <td>{{ $item->role->name }}</td> --}}
    <td>{{ $item->created_at->format('d/m/y') }}</td>
    <td>
        <a href="{{ route('admin.orders.edit', $item) }}" class="btn btn-success">Edit</a>
    </td>
</tr>
@endforeach