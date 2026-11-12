
@extends('layouts.app')

@section('title', 'Stock Movements Report')

@section('content')

<div class="container">

    <h2 class="mb-4">Stock Movements Report</h2>

    <!-- Movement Summary -->
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0">Movement Summary (Last 30 Days)</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Type</th>
                            <th>Number of Moves</th>
                            <th>Total Quantity</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($summary as $item)
                            <tr>
                                <td>{{ ucfirst($item->type) }}</td>
                                <td>{{ $item->total_moves }}</td>
                                <td>{{ $item->total_qty }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    No movements found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Movement Details -->
    <div class="card shadow-sm">

        <div class="card-header">
            <h5 class="mb-0">Stock Movement History</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-bordered">

                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>User</th>
                            <th>Note</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($movements as $movement)

                            <tr>
                                <td>{{ $movement->created_at }}</td>

                                <td>
                                    {{ $movement->product->name ?? 'Deleted Product' }}
                                </td>

                                <td>
                                    @if($movement->type == 'in')
                                        <span class="badge bg-success">In</span>
                                    @else
                                        <span class="badge bg-danger">Out</span>
                                    @endif
                                </td>

                                <td>{{ $movement->quantity }}</td>

                                <td>
                                    {{ $movement->user->name ?? 'Unknown' }}
                                </td>

                                <td>{{ $movement->note ?? '-' }}</td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center">
                                    No stock movements found.
                                </td>
                            </tr>

                        @endforelse
                    </tbody>

                </table>
            </div>

            {{ $movements->links() }}

        </div>
    </div>

    <a href="{{ route('reports.index') }}"
       class="btn btn-secondary mt-3">
        Back to Reports
    </a>

</div>

@endsection
