@extends('admin.layout.admin')

@section('main-content')
        <h1 class="text-2xl font-bold mb-6">Summary</h1>
        <!-- DataTable -->
        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Header</h6>
            </div> --}}
            <div class="card-body">
                <div class="table-responsive">

                    @if (session('success'))
                        <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.orders.update') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
                        @csrf

                        {{-- <div class="mb-4">
                            <label for="prod_id" class="block text-sm font-medium text-gray-700">Product ID</label>
                            <input type="text" name="prod_id" id="prod_id" value="{{ old('prod_id') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div> --}}
                        <table width="100%">
                            <tr>
                                <td>Name</td>
                                <td>: {{ $orders->fullname }} ( {{ $orders->user_id }} )</td>
                                <td>Email</td>
                                <td>: {{ $orders->email }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>: {{ $orders->address }}</td>
                                <td>City</td>
                                <td>: {{ $orders->city }}</td>
                            </tr>
                            <tr>
                                <td>Postcode</td>
                                <td>: {{ $orders->postcode }}</td>
                                <td>State</td>
                                <td>: {{ $orders->state }}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>: {{ $orders->country }}</td>
                                <td>Phone Number</td>
                                <td>: {{ $orders->phone }}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>: {{ $orders->total_lots }} PTS</td>
                                <td>Status</td>
                                <td><select name="status" class="form-control form-control-user">
                                        <option value="{{ $orders->status }}">{{ $orders->status }}</option>
                                        <option value="Ordered">Ordered</option>
                                        <option value="Processing">Processing</option>
                                        <option value="Shipping">Shipping</option>
                                        <option value="Completed">Pending</option>
                                    </select>
                                </td>
                            </tr>
                        </table>

                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="hidden" name="order_id" value="{{ $orders->id }}">
                                <button type="submit" class="form-control btn btn-success">Save</button>
                            </div>
                            <div class="col-sm-2">
                                <a href="{{ route('admin.orders.listing') }}" class="form-control btn btn-primary">Cancel</a>
                            </div>
                        </div>
                        <br>

                    </form>

                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Header</h6>
            </div> --}}
            <div class="card-body">
                <div class="table-responsive">

                    @if ($orderItems->isNotEmpty())

                        @foreach ($orderItems as $item)
                            <div class="w-full mx-auto mt-2 p-2 bg-white rounded-lg shadow-lg">
                                <div class="flex items-center space-x-4">
                                    <img
                                        src="../../public/products/{{ $item->prod_img }}"
                                        alt="Cypher Baseball Cap"
                                        class="w-32 rounded-lg"
                                        style="width:20%;"
                                        />
                                    <div>
                                        <h3 class="text-md font-semibold text-gray-900">
                                            {{ $item->prod_name }}
                                        </h3>
                                        <p class="text-sm text-gray-700">{{ $item->lots }}PTS</p>
                                        <p class="text-sm text-gray-700">SIZE : {{ $item->size }}</p>
                                        <p class="text-sm text-gray-700">QUANTITY : {{ $item->quantity }}</p>
                                        <p class="text-sm text-gray-700">SUB-TOTAL: {{ $item->lots * $item->quantity }} PTS</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @else
                        <div class="w-full mx-auto mt-6 p-6 bg-white rounded-lg shadow-lg">
                            <p> No item in your cart </p>
                        </div>
                    @endif

                </div>
            </div>
        </div>

@endsection


