@extends('layout.ordertemplate')

@section('main-content')
<!-- Tabs -->


<!-- Grid Product -->
<div class="flex flex-col gap-6">
    <!-- Card Produk 1 -->

    @foreach ($orders as $order)
        <div class="flex flex-col md:flex-row p-6 bg-white shadow-lg rounded-lg w-full mx-auto mb-6">
            <div class="w-full md:w-1/3">
                @if (isset($orderItems[$order->id]))
                    <a href="order-{{ $order->id }}">
                    <img
                        src="{{ asset('vestrado10/public/products/' . ($orderItems[$order->id]->prod_img ?? 'default.png')) }}"
                        alt="{{ $orderItems[$order->id]->prod_name ?? 'Product Image' }}"
                        class="w-full md:w-56 h-auto rounded-lg" />
                        </a>
                @else
                    <img
                        src="{{ asset('public/products/default.png') }}"
                        alt="No Item"
                        class="w-full md:w-56 h-auto rounded-lg" />
                @endif
            </div>
            <div class="mt-4 md:mt-0 md:ml-6 w-full md:w-2/3">
                <p class="text-gray-500 text-sm uppercase tracking-wide">
                    Order Details
                </p>
                <div class="mt-3 grid grid-cols-2 pt-10 gap-y-2 text-sm text-gray-700">
                    <p class="font-medium text-gray-900">Order ID:</p>
                    <p><a href="order-{{ $order->id }}">{{ $order->id }}</a></p>

                    <p class="font-medium text-gray-900">Order At:</p>
                    <p>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}</p>

                    {{-- <p class="font-medium text-gray-900">Redeem With:</p>
                    <p>{{ ucfirst($order->redemption_type) }}</p> --}}

                    <p class="font-medium text-gray-900">Status:</p>
                    <p class="text-green-600 font-medium">{{ ucfirst($order->status) }}</p>

                    <p class="font-medium text-gray-900">Total:</p>
                    <p>
                        @if ($order->redemption_type === 'points')
                            {{ number_format($order->total_pts, 2) }} PTS
                        @else
                            {{ number_format($order->total_lots, 2) }} PTS
                        @endif
                    </p>
                </div>
            </div>
        </div>
    @endforeach

    <!-- ... -->
</div>
@endsection
