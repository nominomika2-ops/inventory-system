
@extends('layouts.app')

@section('title', 'Stock Value Report')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Stock Value Report</h2>

        <button onclick="window.print()" class="btn btn-primary d-print-none">
            Print Report
        </button>
    </div>

    <form method="GET" action="{{ route('reports.stock-value') }}" class="mb-3 d-print-none">
        <div class="row">
            <div class="col-md-4">
                <select name="category_id" class="form-select">
                    <option value="">All Categories</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-success">Filter</button>
            </div>
        </div>
    </form>

    <div class="card mb-3">
        <div class="card-body">
            <h5>Total Stock Value</h5>
            <h3>{{ number_format($totalValue, 2) }}</h3>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Value</th>
                </tr>
            </thead>

            <tbody>
                @forelse($rows as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->category_name }}</td>
                        <td>{{ $row->stock }}</td>
                        <td>{{ number_format($row->price, 2) }}</td>
                        <td>{{ number_format($row->value, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No products found.</td>
                    </tr>
                @endforelse
            </tbody>

            <tfoot>
                <tr>
                    <th colspan="4" class="text-end">Total Stock Value</th>
                    <th>{{ number_format($totalValue, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <a href="{{ route('reports.index') }}" class="btn btn-secondary d-print-none">
        Back to Reports
    </a>

</div>
@endsection
