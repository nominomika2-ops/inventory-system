
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">Inventory Dashboard</h2>

    {{-- Dashboard Cards --}}
    <div class="row g-3 mb-4">

        <div class="col-md">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Products</h5>
                    <h2>{{ $productCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Categories</h5>
                    <h2>{{ $categoryCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Suppliers</h5>
                    <h2>{{ $supplierCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h5>Total Stock</h5>
                    <h2>{{ $totalStock }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Low Stock</h5>
                    <h2>{{ $lowStockCount }}</h2>
                </div>
            </div>
        </div>

    </div>


    {{-- Low Stock Products --}}
    <div class="card mb-4">

        <div class="card-header">
            <h5 class="mb-0">Low Stock Products</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Stock</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($lowStock as $product)

                            <tr>
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}">
                                        {{ $product->name }}
                                    </a>
                                </td>

                                <td>
                                    {{ $product->category->name ?? 'No Category' }}
                                </td>

                                <td>
                                    <span class="badge bg-danger">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center">
                                    No low stock products found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- Recent Stock Movements --}}
    <div class="card mb-4">

        <div class="card-header">
            <h5 class="mb-0">Recent Stock Movements</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>User</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($recentMovements as $movement)

                            <tr>
                                <td>
                                    {{ $movement->product->name ?? 'Unknown Product' }}
                                </td>

                                <td>
                                    {{ ucfirst($movement->type) }}
                                </td>

                                <td>
                                    {{ $movement->quantity }}
                                </td>

                                <td>
                                    {{ $movement->user->name ?? 'Unknown User' }}
                                </td>

                                <td>
                                    {{ $movement->created_at->format('Y-m-d H:i') }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center">
                                    No stock movements found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
