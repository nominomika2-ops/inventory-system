<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function summary()
    {
        $summary = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'categories.name as category_name',
                DB::raw('COUNT(products.id) as total_products'),
                DB::raw('COALESCE(SUM(products.stock), 0) as total_stock')
            )
            ->groupBy('categories.id', 'categories.name')
            ->get();

        return view('stock.summary', ['summary' => $summary]);
    }
}