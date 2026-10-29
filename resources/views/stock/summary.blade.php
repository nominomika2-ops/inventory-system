blade
@extends('layouts.app')

@section('title', 'Stock Summary')

@section('content')
    <div class="container">
        <h2>Stock Summary</h2>

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Total Products</th>
                    <th>Total Stock</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($summary as $item)
                    <tr>
                        <td>{{ $item->category_name ?? 'Uncategorized' }}</td>
                        <td>{{ $item->total_products }}</td>
                        <td>{{ $item->total_stock }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No stock data available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
