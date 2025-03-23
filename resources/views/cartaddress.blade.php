@extends('layout.carttemplate')

@section('main-content')
<!-- Grid Product -->
<div class="flex flex-col gap-6">
    @if ($cartItems->isNotEmpty())
    <form action="{{ route('cart.review') }}" method="POST">
        @csrf
        <!-- Card Produk 1 -->
        <div class="p-6 rounded-lg shadow-lg">
            <div class="flex rounded-lg justify-between">
                <div class="flex flex-col w-1/2 rounded-lg space-y-6">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Cart Summary
                    </h2>
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Subtotal</span>
                        <span>{{ number_format($totalPts) }} PTS/ {{ number_format($totalLots) }} LOTS</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-700 mt-2">
                        <span>Delivery Fee</span>
                        <span>Free</span>
                    </div>
                    <div
                        class="flex justify-between text-lg font-bold text-gray-900 mt-4">
                        <span>Total</span>
                        <span>{{ number_format($totalPts) }} PTS/ {{ number_format($totalLots) }} LOTS</span>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-20">
                    <a href="{{ route('cart.index') }}"
                    class="p-2 w-full h-full border border-black text-black rounded-lg text-center">Back to Cart
                    </a>
                    <button
                        class="p-2 w-full h-full border border-black bg-black text-white rounded-lg text-center">
                        Proceed to Review
                    </button>
                </div>
            </div>
        </div>
        <!-- Card Address  -->

        <div class="w-full mx-auto mt-6 p-6 bg-white rounded-lg shadow-lg">

            <div class="mt-2 grid grid-cols-2 gap-y-2 text-sm text-gray-700">
                <p class="font-medium text-gray-900">Name:</p>
                <input type="text" name="fullname" value="{{ $datauser['firstName'] }} {{ $datauser['lastName'] }}" class="border p-1 rounded-lg w-12 text-left" style="width:100%;" />

                <p class="font-medium text-gray-900">Address:</p>
                <input type="text" name="address" class="border p-1 rounded-lg w-12 text-left" style="width:100%;" name="address" value="{{ $datauser['address'] }}" />

                <p class="font-medium text-gray-900">City:</p>
                <input type="text" name="city" class="border p-1 rounded-lg w-12 text-left" style="width:100%;" name="address" value="{{ $datauser['city'] }}" />

                <p class="font-medium text-gray-900">Postcode:</p>
                <input type="text" name="postcode" class="border p-1 rounded-lg w-12 text-left" style="width:100%;" name="address" value="{{ $datauser['zipCode'] }}" />

                <p class="font-medium text-gray-900">State:</p>
                <input type="text" name="state" class="border p-1 rounded-lg w-12 text-left" style="width:100%;" name="address" value="{{ $datauser['state'] }}" />

                <p class="font-medium text-gray-900">Country:</p>
                <input type="text" name="country" class="border p-1 rounded-lg w-12 text-left" style="width:100%;" name="address" value="{{ $datauser['country'] }}" />

                <p class="font-medium text-gray-900">E-mail:</p>
                <input type="text" name="email" class="border p-1 rounded-lg w-12 text-left" style="width:100%;" name="address" value="{{ $datauser['email'] }}" />

                <p class="font-medium text-gray-900">Phone Number:</p>
                <input type="text" name="phone" class="border p-1 rounded-lg w-12 text-left" style="width:100%;" name="address" value="{{ $datauser['phone'] }}" />
            </div>

        </div>
    </form>

    @else
        <div class="w-full mx-auto mt-6 p-6 bg-white rounded-lg shadow-lg">
            <p> No item in your cart </p>
        </div>
    @endif

    <!-- Card Produk  -->
    {{-- <div class="w-full mx-auto mt-6 p-6 bg-white rounded-lg shadow-lg">
        <div class="flex items-center space-x-4">
            <img
                src="assets/images/Thumb1_4645Campus.png"
                alt="Cypher Baseball Cap"
                class="w-64 rounded-lg" />
            <div>
                <h3 class="text-md font-semibold text-gray-900">
                    Cypher Baseball Cap
                </h3>
                <p class="text-sm text-gray-700">330PTS / 200LOTS</p>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-2 gap-y-2 text-sm text-gray-700">
            <p class="font-medium text-gray-900">Size:</p>
            <select class="border p-1 rounded-lg">
                <option>S</option>
                <option>M</option>
                <option>L</option>
            </select>
            <p class="font-medium text-gray-900">Quantity:</p>
            <input
                type="number"
                value="1"
                class="border p-1 rounded-lg w-12 text-center" />
        </div>
        <div class="flex mt-4 space-x-2">
            <button
                class="w-1/2 p-2 text-gray-900 border border-black rounded-lg">
                MAKE FAVOURITE
            </button>
            <button class="w-1/2 p-2 bg-black text-white rounded-lg">
                DELETE
            </button>
        </div>
    </div> --}}
</div>

@endsection
