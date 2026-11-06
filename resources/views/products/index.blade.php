
@extends('layouts.app')

@section('title', 'Products List')

@section('content')

    <h2>Products List</h2>

    @can('manage-products')
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            Add Product
        </a>
    @endcan

    <br><br>

    @foreach ($products as $product)
        <div>
            <h3>{{ $product->name }}</h3>

            <p>Stock: {{ $product->stock }}</p>

            <p>Price: {{ $product->price }}</p>

            <p>Category: {{ $product->category?->name ?? 'No Category' }}</p>

            <p>
                Suppliers:
                {{ $product->suppliers->pluck('name')->join(', ') ?: 'No Suppliers' }}
            </p>

            <a href="{{ route('products.show', $product->id) }}">
                View Details
            </a>
        </div>

        <hr>
    @endforeach

@endsection
