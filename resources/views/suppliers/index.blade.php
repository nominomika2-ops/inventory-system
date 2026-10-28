
@extends('layouts.app')

@section('title', 'Suppliers List')

@section('content')
    <div class="container mt-4">
        <h1>Suppliers List</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->id }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->email ?? 'Email not available' }}</td>
                        <td>{{ $supplier->phone ?? 'Phone not available' }}</td>
                        <td>
                            <a href="{{ route('suppliers.show', $supplier->id) }}">
                                View Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No suppliers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
