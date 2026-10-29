blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Inventory System</title>
</head>
<body>
    <h1>Inventory System</h1>

    <nav>
        <a href="{{ route('products.index') }}">Products</a> |
        <a href="{{ route('categories.index') }}">Categories</a> |
        <a href="{{ route('suppliers.index') }}">Suppliers</a> |
        <a href="{{ route('products.low-stock') }}">Low Stock</a>
        <a href="{{ route('stock.summary') }}">Stock Summary</a>
    </nav>

    <hr>

    @yield('content')
</body>
</html>
