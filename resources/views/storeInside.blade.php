@extends('layout.storeInside')

@section('main-content')

<main class=" grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <img
        src="public/products/{{ $product->prod_img }}"
        alt="Hoodie"
        class="w-full h-50 object-cover rounded-md mb-4" />
        <div class="flex space-x-2">
            <img
            src="public/products/{{ $product->prod_img }}"
            class="w-20 h-20 rounded-md cursor-pointer" />
            <img
            src="public/products/{{ $product->prod_img }}"
            class="w-20 h-20 rounded-md cursor-pointer" />
            <img
            src="public/products/{{ $product->prod_img }}"
            class="w-20 h-20 rounded-md cursor-pointer" />
        </div>
    </div>
    <div class="bg-white p-6 rounded-lg ">
        <h2 class="text-2xl font-bold">{{ $product->prod_name ?? 'N/A' }}</h2>
        <div class="flex items-center mb-1">
            <div class="flex items-center mb-1">
                <!-- Rating (bintang) -->
                <svg
                class="w-4 h-4 text-green-500 mr-1"
                fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902
                        0l1.286 3.966a1 1 0 00.95.69h4.167c.969
                        0 1.371 1.24.588 1.81l-3.37 2.448a1 1
                        0 00-.363 1.118l1.286 3.966c.3.921-.755
                        1.688-1.54 1.118l-3.37-2.448a1 1 0
                        00-1.176 0l-3.37 2.448c-.784.57-1.84-
                        .197-1.54-1.118l1.286-3.966a1 1
                        0 00-.363-1.118L2.098 9.393c-.783-
                        .57-.38-1.81.588-1.81h4.167a1 1
                        0 00.95-.69l1.286-3.966z"></path>
                </svg>
                <svg
                class="w-4 h-4 text-green-500 mr-1"
                fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902
                        0l1.286 3.966a1 1 0 00.95.69h4.167c.969
                        0 1.371 1.24.588 1.81l-3.37 2.448a1 1
                        0 00-.363 1.118l1.286 3.966c.3.921-.755
                        1.688-1.54 1.118l-3.37-2.448a1 1 0
                        00-1.176 0l-3.37 2.448c-.784.57-1.84-
                        .197-1.54-1.118l1.286-3.966a1 1
                        0 00-.363-1.118L2.098 9.393c-.783-
                        .57-.38-1.81.588-1.81h4.167a1 1
                        0 00.95-.69l1.286-3.966z" />
                </svg>
                <svg
                class="w-4 h-4 text-green-500 mr-1"
                fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902
                        0l1.286 3.966a1 1 0 00.95.69h4.167c.969
                        0 1.371 1.24.588 1.81l-3.37 2.448a1 1
                        0 00-.363 1.118l1.286 3.966c.3.921-.755
                        1.688-1.54 1.118l-3.37-2.448a1 1 0
                        00-1.176 0l-3.37 2.448c-.784.57-1.84-
                        .197-1.54-1.118l1.286-3.966a1 1
                        0 00-.363-1.118L2.098 9.393c-.783-
                        .57-.38-1.81.588-1.81h4.167a1 1
                        0 00.95-.69l1.286-3.966z" />
                </svg>
                <svg
                class="w-4 h-4 text-green-500 mr-1"
                fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902
                        0l1.286 3.966a1 1 0 00.95.69h4.167c.969
                        0 1.371 1.24.588 1.81l-3.37 2.448a1 1
                        0 00-.363 1.118l1.286 3.966c.3.921-.755
                        1.688-1.54 1.118l-3.37-2.448a1 1 0
                        00-1.176 0l-3.37 2.448c-.784.57-1.84-
                        .197-1.54-1.118l1.286-3.966a1 1
                        0 00-.363-1.118L2.098 9.393c-.783-
                        .57-.38-1.81.588-1.81h4.167a1 1
                        0 00.95-.69l1.286-3.966z" />
                </svg>
                <svg
                class="w-4 h-4 text-green-500"
                fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902
                        0l1.286 3.966a1 1 0 00.95.69h4.167c.969
                        0 1.371 1.24.588 1.81l-3.37 2.448a1 1
                        0 00-.363 1.118l1.286 3.966c.3.921-.755
                        1.688-1.54 1.118l-3.37-2.448a1 1 0
                        00-1.176 0l-3.37 2.448c-.784.57-1.84-
                        .197-1.54-1.118l1.286-3.966a1 1
                        0 00-.363-1.118L2.098 9.393c-.783-
                        .57-.38-1.81.588-1.81h4.167a1 1
                        0 00.95-.69l1.286-3.966z" />
                </svg>
            </div>
        </div>
        <p class="text-green-600 font-semibold text-lg">
            {{ $product->pts }} Points / {{ $product->lots }} Lots
        </p>
        <p class="text-gray-600 mt-2">
            {{ $product->prod_desc }}
        </p>
        <p class="text-sm text-gray-500 mt-2">Materials: {{ $product->material }}</p>
        <p class="text-sm text-gray-500">Product SKU: {{ $product->sku }}</p>
        <div class="mt-4">
            <h3 class="font-semibold">Select Size</h3>
            <div class="flex space-x-2 mt-2">
                @if (!empty($sizes))
                    @foreach ($sizes as $size)
                        <button
                        class="border px-3 py-1 rounded-md size-btn"
                        data-size="{{ $size }}"
                        onclick="selectSize(this, '{{ $size }}')">
                        {{ $size }}
                        </button>
                    @endforeach
                @else
                    <p>No sizes available</p>
                @endif
                <input type="hidden" id="selectedSize" value="">
            </div>
        </div>
        <div class="mt-6 flex space-x-4">
            @if(isset($islogin) && $islogin)
            <button id="getThisBtn"
            class="px-6 py-2 bg-black text-white rounded-md"
            onclick="openModalWithSize('{{ $product->prod_name }}', '{{ $product->prod_id }}', '{{ $product->pts ?? 'N/A' }}', '{{ $product->lots ?? 'N/A' }}', '{{ $product->prod_img ?? 'public/products/default.png' }}', '{{ $product->sku ?? 'N/A' }}')">
            GET THIS
            </button>
            @endif
            <button onclick="(window.location.href) = '{{ route('store') }}';" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md">
            BACK
            </button>
        </div>
    </div>

</main>

<div class="w-full p-6 bg-white ">
    <h3 class="text-lg font-bold mb-4">You May Also Like</h3>
    <div class="flex w-full gap-6">
        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <img src="public/products/Thumb1_Camp57us.png" class="w-full h-50 object-cover rounded-md mb-4"/>
            <h4 class="text-md font-semibold">Vestrado's Campus Tees</h4>
            <p class="text-green-600 text-sm">50 LOTS / 370PTS</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <img src="public/products/Thumb1_4645Campus.png" class="w-full h-50 object-cover rounded-md mb-4"/>
            <h4 class="text-md font-semibold">Vestrado's Campus Cap</h4>
            <p class="text-green-600 text-sm">50 LOTS / 370PTS</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <img src="public/products/Thumb1_Cam4564pus.png" class="w-full h-50 object-cover rounded-md mb-4"/>
            <h4 class="text-md font-semibold">Vestrado's Trading Plan</h4>
            <p class="text-green-600 text-sm">50 LOTS / 370PTS</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <img src="public/products/Thumb1_Cam465465pus.png" class="w-full h-50 object-cover rounded-md mb-4"/>
            <h4 class="text-md font-semibold">Vestrado's Trading Plan</h4>
            <p class="text-green-600 text-sm">50 LOTS / 370PTS</p>
        </div>
    </div>
</div>

@endsection
