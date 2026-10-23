
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Supplier Details</h1>

        <p><strong>ID:</strong> {{ $supplier['id'] }}</p>
        <p><strong>Name:</strong> {{ $supplier['name'] }}</p>
        <p><strong>Email:</strong> {{ $supplier['email'] }}</p>
        <p><strong>Phone:</strong> {{ $supplier['phone'] }}</p>

        <a href="{{ route('suppliers.index') }}" class="btn btn-primary">
            Back to List
        </a>
    </div>
@endsection
