@extends('admin.layout.admin')

@section('main-content')

    <h1 class="text-2xl font-bold mb-6">Pending Order Listing</h1>

    <!-- DataTable -->
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Header</h6>
        </div> --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Order Date</th>
                            <th>LOTS</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->fullname }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->total_lots }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.view', $item->id) }}" class="btn btn-primary btn-circle btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                      </a>
                                    <!-- Delete form -->
                                    {{-- <form action="{{ route('admin.products.delete', ['prodid' => $item->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        <input type="hidden" name="prodid" value="{{ $item->id }}">
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                                    </form> --}}


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection


