
@extends('layouts.app')

@section('title', 'Suppliers List')

@section('content')

<div class="container mt-4">

    <h1>Suppliers List</h1>

    @can('manage-products')
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">
            Add Supplier
        </a>
    @endcan

    {{-- Search and City Filter --}}
    <form method="GET" action="{{ route('suppliers.index') }}" class="row g-2 mb-4">

        <div class="col-md-5">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search supplier name or city..."
                value="{{ request('search') }}"
            >
        </div>

        <div class="col-md-4">
            <select name="city" class="form-select">

                <option value="">All Cities</option>

                @foreach ($cities as $city)
                    <option
                        value="{{ $city }}"
                        {{ request('city') == $city ? 'selected' : '' }}
                    >
                        {{ $city }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-success">
                Search / Filter
            </button>

            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                Reset
            </a>
        </div>

    </form>

    {{-- Suppliers Table --}}
    <table class="table table-bordered table-striped">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
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

                    <td>{{ $supplier->city ?? 'City not available' }}</td>

                    <td>
                        <a
                            href="{{ route('suppliers.show', $supplier->id) }}"
                            class="btn btn-info btn-sm"
                        >
                            View Details
                        </a>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="6" class="text-center">
                        No suppliers found.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    {{-- Pagination Information --}}
    <p class="text-muted">
        Showing {{ $suppliers->firstItem() ?? 0 }}
        to {{ $suppliers->lastItem() ?? 0 }}
        of {{ $suppliers->total() }} suppliers
    </p>

    {{-- Pagination Links --}}
    {{ $suppliers->links() }}

</div>

@endsection
