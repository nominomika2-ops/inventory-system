
@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container mt-4">

    <h1>Edit Product</h1>

    <form action="{{ route('products.update', $product->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- Product Name --}}
        <div class="mb-3">
            <label class="form-label">Product Name</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $product->name) }}">

            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        {{-- Category --}}
        <div class="mb-3">
            <label class="form-label">Category</label>

            <select name="category_id" class="form-control">
                <option value="">Select Category</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        {{-- Price --}}
        <div class="mb-3">
            <label class="form-label">Price</label>

            <input type="number"
                   step="0.01"
                   name="price"
                   class="form-control"
                   value="{{ old('price', $product->price) }}">

            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        {{-- Current Image --}}
        <div class="mb-3">
            <label class="form-label">Current Image</label><br>

            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     width="150"
                     class="mb-2"
                     alt="Current Product Image">
            @else
                <p>No image uploaded.</p>
            @endif
        </div>


        {{-- New Image --}}
        <div class="mb-3">
            <label class="form-label">Upload New Image</label>

            <input type="file"
                   name="image"
                   class="form-control">

            <small class="text-muted">
                Leave empty to keep the current image.
            </small>

            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        {{-- Suppliers --}}
        <div class="mb-3">
            <label class="form-label">Suppliers</label>

            @php
                $selectedSuppliers = old(
                    'suppliers',
                    $product->suppliers->pluck('id')->toArray()
                );
            @endphp

            @foreach ($suppliers as $supplier)
                <div class="form-check">

                    <input class="form-check-input"
                           type="checkbox"
                           name="suppliers[]"
                           value="{{ $supplier->id }}"
                           id="supplier{{ $supplier->id }}"
                           {{ in_array($supplier->id, $selectedSuppliers) ? 'checked' : '' }}>

                    <label class="form-check-label"
                           for="supplier{{ $supplier->id }}">
                        {{ $supplier->name }}
                    </label>

                </div>
            @endforeach

            @error('suppliers')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            @error('suppliers.*')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        {{-- Buttons --}}
        <button type="submit" class="btn btn-primary">
            Update Product
        </button>

        <a href="{{ route('products.show', $product->id) }}"
           class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>
@endsection
