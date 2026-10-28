
@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
    <div class="product">
        <h1>Product Details</h1>

        <h3>{{ $product->name }}</h3>

        <p>Product ID: {{ $product->id }}</p>

        <p>Available Stock: {{ $product->stock }}</p>

        <p>Price: {{ $product->price }}</p>

        <p>
            Category: {{ $product->category?->name ?? 'No category assigned' }}
        </p>
        
@if ($product->detail)
    <h3>Product Additional Details</h3>

    <p>Barcode: {{ $product->detail->barcode }}</p>

    <p>
        Description:
        {{ $product->detail->description ?? 'No description available' }}
    </p>
@else
    <p>No detail yet</p>
@endif


        <a class="btn" href="{{ route('products.index') }}">
            Back to Products
        </a>
    </div>
@endsection
