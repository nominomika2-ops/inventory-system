
@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Add New Category</h2>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>

            <input
                type="text"
                name="name"
                id="name"
                class="form-control"
                value="{{ old('name') }}"
            >

            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Category</button>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
            Cancel
        </a>
    </form>
</div>

@endsection
