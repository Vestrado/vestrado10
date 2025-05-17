<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Product</h1>

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

        <form action="{{ route('admin.products.update') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf

            {{-- <div class="mb-4">
                <label for="prod_id" class="block text-sm font-medium text-gray-700">Product ID</label>
                <input type="text" name="prod_id" id="prod_id" value="{{ old('prod_id') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div> --}}

            <div class="mb-4">
                <label for="prod_name" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="prod_name" id="prod_name" value="{{ $products->prod_name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="prod_desc" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="prod_desc" id="prod_desc" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>{{ $products->prod_desc }}</textarea>
            </div>

            <div class="mb-4">
                <label for="pts" class="block text-sm font-medium text-gray-700">Points (PTS)</label>
                <input type="number" name="pts" id="pts" value="{{ $products->pts }}" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="lots" class="block text-sm font-medium text-gray-700">Lots</label>
                <input type="number" name="lots" id="lots" value="{{ $products->lots }}" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="material" class="block text-sm font-medium text-gray-700">Material</label>
                <input type="text" name="material" id="material" value="{{ $products->material }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                <input type="text" name="sku" id="sku" value="{{ $products->sku }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="prod_img" class="block text-sm font-medium text-gray-700">Product Image</label>
                <input type="file" name="prod_img" id="prod_img" class="mt-1 block w-full">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Sizes</label>
                <div class="flex space-x-2">
                    <label><input type="checkbox" name="size[]" value="S" {{ in_array('S', explode(',', $products->size)) ? 'checked' : '' }}> S</label>
                    <label><input type="checkbox" name="size[]" value="M" {{ in_array('M', explode(',', $products->size)) ? 'checked' : '' }}> M</label>
                    <label><input type="checkbox" name="size[]" value="L" {{ in_array('L', explode(',', $products->size)) ? 'checked' : '' }}> L</label>
                    <label><input type="checkbox" name="size[]" value="XL" {{ in_array('XL', explode(',', $products->size)) ? 'checked' : '' }}> XL</label>
                </div>
            </div>

            <div class="mt-6">
                <input type="hidden" name="prod_id" value="{{ $products->prod_id }}">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Save</button>
                <a href="{{ route('admin.products.listing') }}" class="ml-4 px-6 py-2 bg-gray-300 text-gray-700 rounded-md">Back</a>
            </div>
        </form>
    </div>
</body>
</html>
