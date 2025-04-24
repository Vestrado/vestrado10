@extends('layout.app')

@section('main-content')
<!--  (Konten Tengah) -->
 {{-- {{ number_format($totalVolume ?? 0, 2) }} --}}
<main class="flex-1 p-4 md:p-6 lg:p-8 space-y-8">
    <!-- Tabs -->
    <div>
        <ul class="flex gap-6 text-sm font-semibold">
            <li class="w-auto border-2 border-black p-2 rounded-lg bg-black">
                <a
                    href="#"
                    class="py-2 text-white"
                    >All Merchandising</a
                >
            </li>
            @if(isset($islogin) && $islogin)
            <li
                class="hover:border-2 hover:border-black p-2 hover:rounded-lg hover:bg-black">
                <a
                    href="{{ route('order.history') }}"
                    class="py-2 text-black hover:text-white"
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
            @endif
        </ul>
    </div>

    <!-- NEW GRID PRODUCT -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <div class="bg-white rounded-lg shadow p-4">
                <a href="{{ route('product.detail', ['id' => $product->prod_id]) }}">
                    <img
                        src="public/products/{{ $product->prod_img ?? 'default.png' }}"
                        alt="{{ $product->prod_name ?? 'Product Image' }}"
                        class="w-full h-50 object-cover rounded-md mb-4" />
                    <h3 class="text-md font-semibold mb-1">
                        {{ $product->prod_name ?? 'N/A' }}
                    </h3>
                    <div class="flex items-center mb-1">
                        <!-- Rating (bintang) -->
                        <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.363 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.363-1.118L2.098 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.966z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.363 1.118l1.286 3.966c.3 .921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784 .57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.363-1.118L2.098 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.966z" />
                        </svg>
                        <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.363 1.118l1.286 3.966c.3 .921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784 .57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.363-1.118L2.098 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.966z" />
                        </svg>
                        <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.363 1.118l1.286 3.966c.3 .921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784 .57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.363-1.118L2.098 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.966z" />
                        </svg>
                        <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.363 1.118l1.286 3.966c.3 .921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784 .57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.363-1.118L2.098 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.966z" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">
                        {{ $product->lots ?? 'N/A' }} LOTS / {{ $product->pts ?? 'N/A' }} PTS
                    </p>
                </a>
            </div>
        @endforeach
    </div>
    <!-- NEW GRID PRODUCT -->

</main>
@endsection
