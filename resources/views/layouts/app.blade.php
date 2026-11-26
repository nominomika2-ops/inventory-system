
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') - Inventory System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body>

@auth

<div class="app-wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="brand">
            <div class="brand-icon">
                <i class="bi bi-box-seam"></i>
            </div>
            <span>Inventory System</span>
        </div>

        <div class="sidebar-label">MAIN MENU</div>

        <nav class="sidebar-menu">

            <a href="{{ route('dashboard') }}"
               class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('products.index') }}"
               class="sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="bi bi-box"></i>
                <span>Products</span>
            </a>

            <a href="{{ route('categories.index') }}"
               class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i>
                <span>Categories</span>
            </a>

            <a href="{{ route('suppliers.index') }}"
               class="sidebar-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                <i class="bi bi-truck"></i>
                <span>Suppliers</span>
            </a>

            <a href="{{ route('products.low-stock') }}"
               class="sidebar-link {{ request()->routeIs('products.low-stock') ? 'active' : '' }}">
                <i class="bi bi-exclamation-triangle"></i>
                <span>Low Stock</span>
            </a>

            <div class="sidebar-label mt-4">MANAGEMENT</div>

            <a href="{{ route('reports.index') }}"
               class="sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart"></i>
                <span>Reports</span>
            </a>

            @can('manage-products')
                <a href="{{ route('users.index') }}"
                   class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            @endcan

        </nav>

        <div class="sidebar-bottom">
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div class="user-info">
                <strong>{{ auth()->user()->name }}</strong>
                <small>{{ auth()->user()->role }}</small>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-icon" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <header class="topbar">
            <button class="menu-toggle" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>

            <div>
                <h5>@yield('title', 'Dashboard')</h5>
                <small>Inventory Management System</small>
            </div>

            <div class="topbar-right">
                <span class="online-dot"></span>
                <span>Welcome, {{ auth()->user()->name }}</span>
            </div>
        </header>

        <div class="page-content">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')

        </div>

        <footer class="footer">
            © {{ date('Y') }} Inventory System. All rights reserved.
        </footer>

    </main>

</div>

@else

    <main class="guest-content">
        <div class="guest-card">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </main>

@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>

</body>
</html>
