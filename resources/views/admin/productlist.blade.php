<!DOCTYPE html>
<html>
<head>
    <title>Product Listing</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <a href="{{ route('admin.dashboard') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-red-600">Dashboard</a>
        <a href="{{ route('admin.products.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-red-600">Add New Product</a>
        <br><br>
        <hr>

        <h1 class="text-2xl font-bold mb-6">Product Listing</h1>

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

        <!-- DataTable -->
        <table id="productsTable" class="display" width="100%">
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
                            <a href="{{ route('admin.products.edit', $item->prod_id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>
                            <!-- Delete form -->
                            <form action="{{ route('admin.products.delete', ['prodid' => $item->prod_id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                <input type="hidden" name="prodid" value="{{ $item->prod_id }}">
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
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

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('#productsTable').DataTable({
                // Optional: Customize DataTable settings
                "paging": true, // Enable pagination
                "searching": true, // Enable search
                "ordering": true, // Enable column sorting
                "info": true, // Show table information
                "pageLength": 10 // Number of rows per page
            });
        });
    </script>
</body>
</html>
