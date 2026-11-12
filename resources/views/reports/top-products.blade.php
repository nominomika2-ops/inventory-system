
@extends('layouts.app')

@section('title', 'Top 5 Products')

@section('content')

<div class="container">

    <h2 class="mb-4">Top 5 Products by Stock Value</h2>

    <div class="card shadow-sm">

        <div class="card-header bg-dark text-white">
            Top 5 Products
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead class="table-dark">
                        <tr>
                            <th>Rank</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Stock Value</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($products as $product)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $product->name }}</td>

                                <td>
                                    {{ $product->category_name ?? 'No Category' }}
                                </td>

                                <td>{{ $product->stock }}</td>

                                <td>
                                    {{ number_format($product->price, 2) }}
                                </td>

                                <td>
                                    <strong>
                                        {{ number_format($product->value, 2) }}
                                    </strong>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center">
                                    No products found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <a href="{{ route('reports.index') }}"
       class="btn btn-secondary mt-3">
        Back to Reports
    </a>

</div>

@endsection
