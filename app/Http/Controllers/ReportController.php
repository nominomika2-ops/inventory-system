<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\StockMovement;

class ReportController extends Controller
{
    // Reports Home
    public function index()
    {
        return view('reports.index');
    }


    // Stock Value Report
    public function stockValue(Request $request)
    {
        $query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.name',
                'categories.name as category_name',
                'products.stock',
                'products.price',
                DB::raw('products.stock * products.price as value')
            );

        if ($request->filled('category_id')) {
            $query->where('products.category_id', $request->category_id);
        }

        $rows = $query
            ->orderBy('category_name')
            ->orderBy('products.name')
            ->get();

        return view('reports.stock-value', [
            'rows' => $rows,
            'totalValue' => $rows->sum('value'),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }


    // Stock Movements Report
    public function movements()
    {
        $from = now()->subDays(30);

        $summary = DB::table('stock_movements')
            ->where('created_at', '>=', $from)
            ->select(
                'type',
                DB::raw('COUNT(*) as total_moves'),
                DB::raw('SUM(quantity) as total_qty')
            )
            ->groupBy('type')
            ->get();

        $movements = StockMovement::with(['product', 'user'])
            ->where('created_at', '>=', $from)
            ->latest()
            ->paginate(15);

        return view('reports.movements', [
            'summary' => $summary,
            'movements' => $movements,
        ]);
    }


    // Top 5 Products by Stock Value
    public function topProducts()
    {
        $products = DB::table('products')
            ->leftJoin(
                'categories',
                'products.category_id',
                '=',
                'categories.id'
            )
            ->select(
                'products.name',
                'categories.name as category_name',
                'products.stock',
                'products.price',
                DB::raw('products.stock * products.price as value')
            )
            ->orderByDesc('value')
            ->limit(5)
            ->get();

        return view('reports.top-products', [
            'products' => $products,
        ]);
    }
}
