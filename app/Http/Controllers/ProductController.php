<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'suppliers'])->get();

        return view('products.index', [
            'products' => $products
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', [
            'product' => $product
        ]);
    }

    public function lowStock()
    {
        $products = DB::table('products')
            ->where('stock', '<', config('inventory.low_stock_limit'))
            ->orderBy('stock')
            ->get();

        return view('products.low-stock', [
            'products' => $products
        ]);
    }
}
