
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Suppliers List</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier['id'] }}</td>
                        <td>{{ $supplier['name'] }}</td>
                        <td>{{ $supplier['email'] }}</td>
                        <td>
                            <a href="{{ route('suppliers.show', $supplier['id']) }}">
                                View Details
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
