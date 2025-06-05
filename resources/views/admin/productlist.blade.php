@extends('admin.layout.admin')

@section('main-content')

    <h1 class="text-2xl font-bold mb-6">Product Listing</h1>

    <!-- DataTable -->
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Header</h6>
        </div> --}}
        <div class="card-body">
            <div class="table-responsive">

                <!-- DataTable -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Desc</th>
                            <th>PTS</th>
                            <th>LOTS</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{ $item->prod_name }}</td>
                                <td>{{ $item->prod_desc }}</td>
                                <td>{{ $item->pts }}</td>
                                <td>{{ $item->lots }}</td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $item->prod_id) }}" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                    <!-- Delete form -->
                                    <form action="{{ route('admin.products.delete', ['prodid' => $item->prod_id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        <input type="hidden" name="prodid" value="{{ $item->prod_id }}">
                                        <button type="submit" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>

                                    {{-- <form action="{{ route('admin.products.listing', $item->prod_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Are you sure?')">Delete</button>
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
