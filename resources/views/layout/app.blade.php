
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
</head>
<body>
    
    <h1>Inventory System</h1>
    
<h1>Inventory System</h1>

<nav>
    <a href="{{ route('products.index') }}">Products</a> |
    <a href="{{ route('categories.index') }}">Categories</a> |
    <a href="{{ route('suppliers.index') }}">Suppliers</a>
</nav>

<hr>

    <hr>
    <h2>{{ config('custom.company_name') }}</h2>

<p>Items per page: {{ config('custom.items_per_page') }}</p>
    @yield('content')

</body>
</html>


