
@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Add New Product</h2>

    <form action="{{ route('products.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <!-- Product Name -->
        <div class="mb-3">
            <label class="form-label">Product Name</label>

            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label class="form-label">Category</label>

            <select name="category_id"
                    class="form-control @error('category_id') is-invalid @enderror">

                <option value="">Select Category</option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>

            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label class="form-label">Price</label>

            <input type="number"
                   step="0.01"
                   name="price"
                   value="{{ old('price') }}"
                   class="form-control @error('price') is-invalid @enderror">

            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Stock -->
        <div class="mb-3">
            <label class="form-label">Stock</label>

            <input type="number"
                   name="stock"
                   value="{{ old('stock') }}"
                   class="form-control @error('stock') is-invalid @enderror">

            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Product Image -->
        <div class="mb-3">

            <label class="form-label">Image (optional)</label>

            <input type="file"
                   name="image"
                   class="form-control @error('image') is-invalid @enderror">

            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <!-- Save Button -->
        <button type="submit" class="btn btn-primary">
            Save Product
        </button>

    </form>

</div>

@endsection
