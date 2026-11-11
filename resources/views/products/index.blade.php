
@extends('layouts.app')

@section('title', 'Products List')

@section('content')

<div class="container mt-4">

    <h2>Products List</h2>

    @can('manage-products')
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
            Add Product
        </a>
    @endcan

    {{-- Search and Filter Form --}}
    <form method="GET" action="{{ route('products.index') }}" class="row g-2 mb-4">

        <div class="col-md-4">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search product name..."
                value="{{ request('search') }}"
            >
        </div>

        <div class="col-md-3">
            <select name="category_id" class="form-select">
                <option value="">All Categories</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="stock" class="form-select">
                <option value="">All Stock</option>

                <option value="low" {{ request('stock') === 'low' ? 'selected' : '' }}>
                    Low Stock
                </option>

                <option value="out" {{ request('stock') === 'out' ? 'selected' : '' }}>
                    Out of Stock
                </option>
            </select>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-success">
                Filter
            </button>

            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                Reset
            </a>
        </div>

    </form>

    {{-- Products List --}}
    @forelse ($products as $product)

        <div class="card mb-3">
            <div class="card-body">

                <h3>{{ $product->name }}</h3>

                {{-- Product Image --}}
                @if ($product->image)

                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        width="50"
                        height="50"
                        style="object-fit: cover;"
                        alt="Product Image"
                    >

                @else

                    <p class="text-muted">No image</p>

                @endif

                <p>Stock: {{ $product->stock }}</p>

                <p>Price: {{ $product->price }}</p>

                <p>
                    Category:
                    {{ $product->category?->name ?? 'No Category' }}
                </p>

                <p>
                    Suppliers:
                    {{ $product->suppliers->pluck('name')->join(', ') ?: 'No Suppliers' }}
                </p>

                <a href="{{ route('products.show', $product->id) }}"
                   class="btn btn-info btn-sm">
                    View Details
                </a>

                @can('manage-products')
                    <a href="{{ route('products.edit', $product->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form
                        action="{{ route('products.destroy', $product->id) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('Are you sure you want to delete this product?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                @endcan

            </div>
        </div>

    @empty

        <div class="alert alert-info">
            No products found.
        </div>

    @endforelse

    {{-- Pagination --}}
    <div class="mt-3">

        <p class="text-muted">
            Showing {{ $products->firstItem() ?? 0 }}
            to {{ $products->lastItem() ?? 0 }}
            of {{ $products->total() }} products
        </p>

        {{ $products->links() }}

    </div>

</div>

@endsection
