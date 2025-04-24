@extends('layout.carttemplate')

@section('main-content')
<!-- Grid Product -->
<div class="flex flex-col gap-6">
    @if ($cartItems->isNotEmpty())
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <!-- Card Produk 1 -->
        <div class="p-6 rounded-lg shadow-lg">
            <div class="flex rounded-lg justify-between">
                <div class="flex flex-col w-1/2 rounded-lg space-y-6">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Summary
                    </h2>
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Name</span>
                        <span>{{ $fullname }}</span>
                        <input type="hidden" name="fullname" value="{{ $fullname }}" />
                    </div>
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Address</span>
                        <span>{{ $address }}</span>
                        <input type="hidden" name="address" value="{{ $address }}" />
                    </div>
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Postcode</span>
                        <span>{{ $postcode }}</span>
                        <input type="hidden" name="postcode" value="{{ $postcode }}" />
                    </div>

                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Country</span>
                        <span>{{ $country }}</span>
                        <input type="hidden" name="country" value="{{ $country }}" />
                    </div>


                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Subtotal</span>
                        <span>{{ number_format($totalLots) }} PTS</span>
                    </div>

                    <div
                        class="flex justify-between text-lg font-bold text-gray-900 mt-4">
                        <span>Total</span>
                        <span>{{ number_format($totalLots) }} PTS</span>
                    </div>
                </div>

                <div class="flex flex-col w-1/3 rounded-lg space-y-6">
                    <div class="flex justify-between text-sm text-gray-700">
                        &nbsp;
                    </div>
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>E-mail</span>
                        <span>{{ $email }}</span>
                        <input type="hidden" name="email" value="{{ $email }}" />
                    </div>
                    <div class="flex justify-between text-sm text-gray-700 text-left">
                        <span>City:</span>
                        <span>{{ $city }}</span>
                        <input type="hidden" name="city" value="{{ $city }}" />
                    </div>
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>State</span>
                        <span>{{ $state }}</span>
                        <input type="hidden" name="state" value="{{ $state }}" />
                    </div>

                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Phone Number</span>
                        <span>{{ $phone }}</span>
                        <input type="hidden" name="phone" value="{{ $phone }}" />
                    </div>
                    <div class="flex justify-between text-sm text-gray-700 mt-2">
                        <span>Delivery Fee</span>
                        <span>Free</span>
                    </div>
                </div>

            </div>
            <br>
            <div class="flex rounded-lg justify-between">

                <div class="flex flex-col w-1/4 rounded-lg space-y-6">
                    <a href="{{ route('cart.index') }}"
                    class="p-2 w-full h-full border border-black text-black rounded-lg text-center">Back to Cart
                    </a>
                </div>
                {{-- <div class="flex flex-col w-1/4 rounded-lg space-y-6">
                    <input type="submit" name="ttl_pts" value="Place Order ( {{ number_format($totalPts) }} PTS)"
                        class="p-2 w-full h-full border border-black bg-black text-white rounded-lg text-center">
                </div>
                <div class="flex flex-col w-1/4 rounded-lg space-y-6">
                        <input type="submit" name="ttl_lots" value="Place Order ( {{ number_format($totalLots) }} LOTS)"
                        class="p-2 w-full h-full border border-black bg-black text-white rounded-lg text-center">
                </div> --}}

                {{-- <div class="flex items-center mb-4">
                    <input type="radio" id="points" name="redemption_type" value="points" class="mr-2" required>
                    <label for="points" class="text-sm">Redeem with Points ({{ $totalPts }} PTS)</label>
                </div>
                <div class="flex items-center mb-4">
                    <input type="radio" id="lots" name="redemption_type" value="lots" class="mr-2">
                    <label for="lots" class="text-sm">Redeem with Lots ({{ $totalLots }} LOTS)</label>
                </div> --}}
                <button type="submit" name="redemption_type" value="lots" class="px-6 py-2 bg-black text-white rounded-md hover:bg-gray-800">Confirm Order</button>
            </div>
        </div>
        <!-- Card Address  -->


    </form>

    <!-- Card Produk  -->
    @foreach ($cartItems as $item)
        <div class="w-full mx-auto mt-2 p-2 bg-white rounded-lg shadow-lg">
            <div class="flex items-center space-x-4">
                <img
                    src="public/products/{{ $item->prod_img }}"
                    alt="Cypher Baseball Cap"
                    class="w-32 rounded-lg" />
                <div>
                    <h3 class="text-md font-semibold text-gray-900">
                        {{ $item->prod_name }}
                    </h3>
                    <p class="text-sm text-gray-700">{{ $item->lots }}PTS</p>
                    <p class="text-sm text-gray-700">SIZE : {{ $item->size }}</p>
                    <p class="text-sm text-gray-700">QUANTITY : {{ $item->quantity }}</p>
                </div>
            </div>
        </div>
    @endforeach

    @else
        <div class="w-full mx-auto mt-6 p-6 bg-white rounded-lg shadow-lg">
            <p> No item in your cart </p>
        </div>
    @endif

    <!-- Card Produk  -->
    {{-- <div class="w-full mx-auto mt-6 p-6 bg-white rounded-lg shadow-lg">
        <div class="flex items-center space-x-4">
            <img
                src="public/products/Thumb1_4645Campus.png"
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
