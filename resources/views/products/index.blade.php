
@extends('layouts.app')

@section('title', 'Products List')

@section('content')
    <h2>Products List</h2>

    @foreach ($products as $product)
        <div>
            <h3>{{ $product->name }}</h3>
            <p>Stock: {{ $product->stock }}</p>
            <p>Price: {{ $product->price }}</p>
            <p>Category: {{ $product->category?->name ?? 'No category assigned' }}</p>

            <a href="{{ route('products.show', $product->id) }}">
                View Details
            </a>
        </div>
        <hr>
    @endforeach
@endsection
