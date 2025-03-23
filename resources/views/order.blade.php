@extends('layout.ordertemplate')

@section('main-content')
<!-- Tabs -->
<div>
    <ul class="flex gap-6 text-sm font-semibold">
        <li
            class="hover:border-2 hover:border-black p-2 hover:rounded-lg hover:bg-black">
            <a
                href="{{ route('store') }}"
                class="py-2 text-black hover:text-white"
                >All Merchandising</a
            >
        </li>
        <li class="w-auto border-2 border-black p-2 rounded-lg bg-black">
            <a
                href="#"
                class="py-2 text-white"
                >Purchase History</a
            >
        </li>
        <li
            class="hover:border-2 hover:border-black p-2 hover:rounded-lg hover:bg-black">
            <a
                href="{{ route('cart.index') }}"
                class="py-2 text-black hover:text-white"
                >Shopping Cart</a
            >
        </li>
    </ul>
</div>

<!-- Grid Product -->
<div class="flex flex-col gap-6">
    <!-- Card Produk 1 -->
    @foreach ($orders as $order)
        <div
            class="flex flex-col md:flex-row p-6 bg-white shadow-lg rounded-lg w-full mx-auto">
            <div class="w-full md:w-1/3">
                <img
                    src="assets/images/Thumb1_4645Campus.png"
                    alt="Vestrado Cypher Baseball Cap"
                    class="w-full md:w-96 h-auto rounded-lg" />
            </div>
            <div class="mt-4 md:mt-0 md:ml-6 w-full md:w-2/3">
                <p class="text-gray-500 text-sm uppercase tracking-wide">
                    Order Details
                </p>
                <div
                    class="mt-3 grid grid-cols-2 pt-10 gap-y-2 text-sm text-gray-700">
                    <p class="font-medium text-gray-900">Order ID:</p>
                    <p>{{ $order->id }}</p>

                    <p class="font-medium text-gray-900">Order At:</p>
                    <p>{{ $order->created_at }}</p>

                    <p class="font-medium text-gray-900">Redeem With:</p>
                    <p>{{ $order->redemption_type }}</p>

                    <p class="font-medium text-gray-900">Status:</p>
                    <p class="text-green-600 font-medium">{{ $order->status}}</p>

                    <p class="font-medium text-gray-900">Total Lots / Point:</p>
                    <p>{{ $order->total_lots}} / {{ $order->total_pts}}</p>
                </div>
            </div>
        </div>
    @endforeach

    <!-- ... -->
</div>
@endsection
