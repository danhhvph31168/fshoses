@foreach ($data as $item)
    <tr>
        <th scope="row">
            <div class="form-check">
            </div>
        </th>

        <td>{{ $item->sku_order }}</td>

        <td class="{{ !($item->user->password == null) ? 'text-info' : '' }}">
            {{ $item->user->name }}</td>
        <td>{{ $item->user_address }}</td>
        <td class="fs-6">{{ $item->user_email }}</td>
        <td>{{ $item->user_phone }}</td>

        <td>{{ number_format($item->total_amount) }} vnđ</td>

        <td class="{{ $item->payment->payments_method == 'vnpay' ? 'text-info' : 'text-warning' }}">
            {{ Str::upper($item->payment->payments_method) }}
        </td>

        <td>{{ $item->staff_id ? $item->staff->name : 'unprocessed' }}</td>

        <td>
            <span class="badge bg-success-subtle text-info">{{ $item->status_order }}</span>
        </td>

        <td>
            <span class="badge bg-danger-subtle text-info">{{ $item->payment->status }}</span>
        </td>

        <td>
            <span class="badge rounded-pill text-bg-success">
                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
        </td>

        <td>
            @foreach ($item->orderItems as $orderItem)
                <div class="d-flex align-items-center mt-2">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar-xl bg-light rounded">
                            <img src="{{ Storage::url($orderItem->productVariant->image) }}" alt=""
                                height="100%" width="100%" class="d-block rounded" />
                        </div>
                    </div>

                    <div class="flex-grow-1">
                        <h5 class="fs-14 mb-2">
                            <a href="#" class="text-body">
                                {{ $orderItem->productVariant->product->name }}
                            </a>
                        </h5>

                        <p class="rounded-circle text-muted mb-1">
                            Color: <i class="ri-checkbox-blank-circle-fill"
                                style="color: {{ $orderItem->productVariant['color']->name }};"></i> -
                            Size: {{ $orderItem->productVariant['size']->name }}
                        </p>
                        <p class="rounded-circle text-muted mb-1">
                            Price:
                            {{ number_format($orderItem->price) }}
                            x {{ $orderItem->quantity }}
                        </p>
                    </div>
                </div>
            @endforeach
        </td>

        <td>
            <ul class="list-inline hstack gap-2 mb-0">
                <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                    data-bs-placement="top" title="Edit">
                    <a href="{{ route('admin.orders.edit', $item) }}" class="btn btn-warning">
                        <i class="ri-pencil-fill"></i>
                    </a>
                </li>
            </ul>
        </td>
    </tr>
    
@endforeach
