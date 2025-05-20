<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Welcome to Admin Dashboard</h1>
        <p class="mb-4">This is a protected admin area.</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
        </form>
        <br>
        <a href="{{ route('admin.products.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-red-600"> Create New Product </a>
        <br></br>
        <a href="{{ route('admin.products.listing') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-red-600"> Product Listing </a>
        <br></br>
        <a href="{{ route('admin.orders.pendinglisting') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-red-600"> Pending Order Listing </a>
        <br><br>
        <a href="{{ route('admin.orders.listing') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-red-600"> Order Listing </a>
    </div>
</body>
</html>
