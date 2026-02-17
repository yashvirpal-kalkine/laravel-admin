@props(['items'])
<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>#Order ID</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($items->count() > 0)
                    @foreach($items as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td>{{ dateFormat($item->created_at) }}</td>
                            <td>{{ currencyformat($item->total) }}</td>
                            <td>
                                @php
                                    $status = paymentStatusBadge($item->status);
                                @endphp
                                <span class="badge rounded-pill {{ $status['class'] }}">
                                    <i class="fas {{ $status['icon'] }} me-1"></i>
                                    {{ $status['text'] }}
                                </span>

                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-secondary">View</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">
                            <p class="text-center p-3">No orders found.</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>