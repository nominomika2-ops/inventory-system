blade
@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
    <div class="container mt-4">
        <h1>Product Details</h1>

        <p><strong>ID:</strong> {{ $product->id }}</p>
        <p><strong>Name:</strong> {{ $product->name }}</p>
        <p><strong>Price:</strong> {{ $product->price }}</p>
        <p><strong>Stock:</strong> {{ $product->stock }}</p>

        <p>
            <strong>Category:</strong>
            {{ $product->category?->name ?? 'No category assigned' }}
        </p>

        <hr>

        <h3>Product Additional Details</h3>

        @if ($product->detail)
            <p><strong>Barcode:</strong> {{ $product->detail->barcode }}</p>
            <p>
                <strong>Description:</strong>
                {{ $product->detail->description ?? 'No description available' }}
            </p>
        @else
            <p>No additional details available.</p>
        @endif

        <hr>

        <h3>Suppliers</h3>

        @if ($product->suppliers->isNotEmpty())
            <ul>
                @foreach ($product->suppliers as $supplier)
                    <li>
                        <a href="{{ route('suppliers.show', $supplier->id) }}">
                            {{ $supplier->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No suppliers assigned.</p>
        @endif

        <a href="{{ route('products.index') }}" class="btn btn-primary">
            Back to Products
        </a>
    </div>
@endsection