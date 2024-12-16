@if ($orders->isEmpty())
    <tr>
        <td colspan="6" class="text-danger fw-bold text-center">No orders found!</td>
    </tr>
@else
    @foreach ($orders as $item)
        <tr class="text-center">
            <td>{{ $loop->iteration }}</td>
            <td>
                <a href="{{ route('getDetailOrderItem', $item->sku_order) }}" class="text-danger fw-bold">
                    {{ $item->sku_order }}
                </a>
            </td>
            <td>{{ $item->created_at->format('d/m/Y') }}</td>
            <td>
                <span
                    class="badge rounded-pill
                        {{ $item->status_order === 'pending'
                            ? 'bg-warning text-dark'
                            : ($item->status_order === 'confirmed'
                                ? 'bg-success'
                                : ($item->status_order === 'processing'
                                    ? 'bg-primary'
                                    : ($item->status_order === 'shipping'
                                        ? 'bg-info text-dark'
                                        : ($item->status_order === 'delivered'
                                            ? 'bg-success text-light'
                                            : ($item->status_order === 'canceled'
                                                ? 'bg-secondary'
                                                : ($item->status_order === 'refunded'
                                                    ? 'bg-light text-muted'
                                                    : 'bg-danger')))))) }}">
                    {{ $item->status_order }}
                </span>
            </td>
            <td>
                {{-- <span
                    class="badge rounded-pill
                        {{ $item->payment->status === 'unpaid'
                            ? 'bg-secondary'
                            : ($item->payment->status === 'pending'
                                ? 'bg-warning text-dark'
                                : ($item->payment->status === 'paid'
                                    ? 'bg-success'
                                    : ($item->payment->status === 'refunded'
                                        ? 'bg-info text-dark'
                                        : 'bg-danger'))) }}">
                    {{ $item->payment->status }}
                </span> --}}
            </td>
            <td>{{ number_format($item->total_amount, 0, ',', '.') }} VNĐ</td>
        </tr>
    @endforeach
@endif
