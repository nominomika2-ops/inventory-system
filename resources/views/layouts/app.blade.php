
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Inventory System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand" href="{{ route('products.index') }}">
                Inventory System
            </a>

            @auth

                <div class="d-flex align-items-center flex-wrap">

                    <a href="{{ route('products.index') }}"
                       class="text-white me-3">
                        Products
                    </a>

                    <a href="{{ route('categories.index') }}"
                       class="text-white me-3">
                        Categories
                    </a>

                    <a href="{{ route('suppliers.index') }}"
                       class="text-white me-3">
                        Suppliers
                    </a>

                    <a href="{{ route('products.low-stock') }}"
                       class="text-white me-3">
                        Low Stock
                    </a>

                    @can('manage-products')
                        <a href="{{ route('users.index') }}"
                           class="text-white me-3">
                            Users
                        </a>
                    @endcan

                    <span class="text-white me-3">
                        {{ auth()->user()->name }}
                    </span>

                    <form action="{{ route('logout') }}"
                          method="POST"
                          class="d-inline">

                        @csrf

                        <button class="btn btn-outline-light btn-sm">
                            Logout
                        </button>

                    </form>

                </div>

            @endauth

        </div>
    </nav>

    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </div>

</body>
</html>
