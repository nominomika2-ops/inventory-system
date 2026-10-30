@extends('layouts.app')

@section('title', 'Low Stock Products')

@section('content')
    <div class="container mt-4">
        <h1>Low Stock Products</h1>

        <p>Products with stock below {{ config('inventory.low_stock_limit') }}</p>

        @if ($products->isNotEmpty())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Available Stock</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No low-stock products found.</p>
        @endif

        <a href="{{ route('products.index') }}" class="btn btn-primary">
            Back to Products
        </a>

    </div>
@endsection