
@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Edit Category</h2>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>

            <input
                type="text"
                name="name"
                id="name"
                class="form-control"
                value="{{ old('name', $category->name) }}"
            >

            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
            Cancel
        </a>
    </form>
</div>

@endsection
