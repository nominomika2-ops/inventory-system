<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\StockMovement;

class DashboardController extends Controller
{
    public function index()
    {
        $limit = config('inventory.low_stock_limit');

        return view('dashboard', [
            'productCount' => Product::count(),

            'categoryCount' => Category::count(),

            'supplierCount' => Supplier::count(),

            'totalStock' => Product::sum('stock'),

            'lowStockCount' => Product::where('stock', '<', $limit)->count(),

            'lowStock' => Product::with('category')
                ->where('stock', '<', $limit)
                ->orderBy('stock')
                ->take(5)
                ->get(),

            'recentMovements' => StockMovement::with(['product', 'user'])
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
