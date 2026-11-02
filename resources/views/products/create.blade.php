
@extends('layouts.app')

@section('title', 'Add Product')

@section('content')

    <div class="container mt-4">

        <h1>Add Product</h1>

        <form action="{{ route('products.store') }}" method="POST">

            @csrf

            {{-- Product Name --}}
            <div class="mb-3">

                <label class="form-label">Name</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror"
                >

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- Category --}}
            <div class="mb-3">

                <label class="form-label">Category</label>

                <select
                    name="category_id"
                    class="form-select @error('category_id') is-invalid @enderror"
                >

                    <option value="">-- Select --</option>

                    @foreach ($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

                @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- Stock --}}
            <div class="mb-3">

                <label class="form-label">Stock</label>

                <input
                    type="number"
                    name="stock"
                    value="{{ old('stock') }}"
                    class="form-control @error('stock') is-invalid @enderror"
                >

                @error('stock')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- Price --}}
            <div class="mb-3">

                <label class="form-label">Price</label>

                <input
                    type="text"
                    name="price"
                    value="{{ old('price') }}"
                    class="form-control @error('price') is-invalid @enderror"
                >

                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <button type="submit" class="btn btn-primary">
                Save
            </button>

            <a href="{{ route('products.index') }}"
               class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

@endsection
