<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Add New Product</h1>

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

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf

            {{-- <div class="mb-4">
                <label for="prod_id" class="block text-sm font-medium text-gray-700">Product ID</label>
                <input type="text" name="prod_id" id="prod_id" value="{{ old('prod_id') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div> --}}

            <div class="mb-4">
                <label for="prod_name" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="prod_name" id="prod_name" value="{{ old('prod_name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="prod_desc" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="prod_desc" id="prod_desc" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('prod_desc') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="pts" class="block text-sm font-medium text-gray-700">Points (PTS)</label>
                <input type="number" name="pts" id="pts" value="{{ old('pts') }}" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="lots" class="block text-sm font-medium text-gray-700">Lots</label>
                <input type="number" name="lots" id="lots" value="{{ old('lots') }}" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="material" class="block text-sm font-medium text-gray-700">Material</label>
                <input type="text" name="material" id="material" value="{{ old('material') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                <input type="text" name="sku" id="sku" value="{{ old('sku') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="prod_img" class="block text-sm font-medium text-gray-700">Product Image</label>
                <input type="file" name="prod_img" id="prod_img" class="mt-1 block w-full">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Sizes</label>
                <div class="flex space-x-2">
                    <label><input type="checkbox" name="size[]" value="S"> S</label>
                    <label><input type="checkbox" name="size[]" value="M"> M</label>
                    <label><input type="checkbox" name="size[]" value="L"> L</label>
                    <label><input type="checkbox" name="size[]" value="XL"> XL</label>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Add Product</button>
                <a href="{{ route('admin.dashboard') }}" class="ml-4 px-6 py-2 bg-gray-300 text-gray-700 rounded-md">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
