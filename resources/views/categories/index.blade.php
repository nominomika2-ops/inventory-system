
@extends('layouts.app')

@section('title', 'Categories List')

@section('content')

<div class="container">

    <h2>Categories List</h2>

    @can('manage-products')
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
            Add Category
        </a>
    @endcan

    @foreach ($categories as $category)

        <div>
            <h3>{{ $category->name }}</h3>

            <p>Number of Products: {{ $category->products->count() }}</p>

            @can('manage-products')

                <a href="{{ route('categories.edit', $category->id) }}"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('categories.destroy', $category->id) }}"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm('Are you sure you want to delete this category?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm">
                        Delete
                    </button>

                </form>

            @endcan

        </div>

        <hr>

    @endforeach

</div>

@endsection
