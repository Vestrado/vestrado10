<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
        <a href="{{ route('admin.products.create') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Add New Product</a>
    </div>
</body>
</html>
