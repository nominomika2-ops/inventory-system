
@extends('layouts.app')

@section('title', 'Reports')

@section('content')

<div class="container">

    <h2 class="mb-4">Inventory Reports</h2>

    <div class="row g-4">

        <!-- Stock Value -->
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Stock Value Report</h5>
                    <p class="card-text">
                        View the total value of available stock.
                    </p>
                    <a href="{{ route('reports.stock-value') }}"
                       class="btn btn-primary">
                        View Report
                    </a>
                </div>
            </div>
        </div>

        <!-- Stock Movements -->
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Stock Movements</h5>
                    <p class="card-text">
                        View stock in and stock out history.
                    </p>
                    <a href="{{ route('reports.movements') }}"
                       class="btn btn-success">
                        View Report
                    </a>
                </div>
            </div>
        </div>

        <!-- Low Stock -->
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Low Stock Report</h5>
                    <p class="card-text">
                        View products with low stock.
                    </p>
                    <a href="{{ route('products.low-stock') }}"
                       class="btn btn-warning">
                        View Report
                    </a>
                </div>
            </div>
        </div>

        <!-- Stock Summary -->
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Stock Summary</h5>
                    <p class="card-text">
                        View stock summary by category.
                    </p>
                    <a href="{{ route('stock.summary') }}"
                       class="btn btn-info">
                        View Report
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- Top 5 Products -->
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h5>Top 5 Products by Stock Value</h5>

            <p>
                View the five products with the highest stock value.
            </p>

            <a href="{{ route('reports.top-products') }}"
               class="btn btn-dark">
                View Top 5 Products
            </a>
        </div>
    </div>

</div>

@endsection
