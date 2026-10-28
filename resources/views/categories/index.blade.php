
@extends('layouts.app')

@section('title', 'Categories List')

@section('content')
    <h2>Categories List</h2>

    @foreach ($categories as $category)
        <div>
            <h3>{{ $category->name }}</h3>

            <p>Number of Products: {{ $category->products->count() }}</p>
        </div>
        <hr>
    @endforeach
@endsection
