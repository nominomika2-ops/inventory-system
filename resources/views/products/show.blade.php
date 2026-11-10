
@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="container mt-4">

    <h1>Product Details</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <p><strong>ID:</strong> {{ $product->id }}</p>
    <p><strong>Name:</strong> {{ $product->name }}</p>
    <p><strong>Price:</strong> {{ $product->price }}</p>
    <p><strong>Stock:</strong> {{ $product->stock }}</p>

    <p>
        <strong>Category:</strong>
        {{ $product->category?->name ?? 'No category assigned' }}
    </p>

    <hr>

    <h3>Product Image</h3>

    @if ($product->image)
        <img
            src="{{ asset('storage/' . $product->image) }}"
            width="200"
            class="mb-3"
            alt="Product Image"
        >
    @else
        <p class="text-muted">No image</p>
    @endif

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

    <hr>

    <h3>Stock In / Stock Out</h3>

    <form action="{{ route('products.stock', $product->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Movement Type</label>

            <select name="type" class="form-control">
                <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>
                    Stock In
                </option>

                <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>
                    Stock Out
                </option>
            </select>

            @error('type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Quantity</label>

            <input
                type="number"
                name="quantity"
                min="1"
                class="form-control"
                value="{{ old('quantity') }}"
                required
            >

            @error('quantity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Note</label>

            <input
                type="text"
                name="note"
                class="form-control"
                value="{{ old('note') }}"
                placeholder="Enter a note (optional)"
            >

            @error('note')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">
            Update Stock
        </button>
    </form>

    <hr>

    <h3>Stock Movement History</h3>

    @if ($product->stockMovements->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Note</th>
                        <th>User</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($product->stockMovements->take(10) as $movement)
                        <tr>
                            <td>{{ $movement->created_at->format('Y-m-d H:i') }}</td>

                            <td>
                                @if ($movement->type == 'in')
                                    <span class="badge bg-success">Stock In</span>
                                @else
                                    <span class="badge bg-danger">Stock Out</span>
                                @endif
                            </td>

                            <td>{{ $movement->quantity }}</td>

                            <td>{{ $movement->note ?? '-' }}</td>

                            <td>{{ $movement->user->name ?? 'Unknown' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-muted">No stock movements recorded yet.</p>
    @endif

    <hr>

    @can('manage-products')
        <a href="{{ route('products.edit', $product->id) }}"
           class="btn btn-warning">
            Edit Product
        </a>

        <form
            action="{{ route('products.destroy', $product->id) }}"
            method="POST"
            class="d-inline"
            onsubmit="return confirm('Are you sure you want to delete this product?')"
        >
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">
                Delete Product
            </button>
        </form>
    @endcan

    <a href="{{ route('products.index') }}" class="btn btn-primary">
        Back to Products
    </a>

</div>
@endsection
