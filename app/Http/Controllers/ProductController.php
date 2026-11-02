<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Display all products
    public function index()
    {
        $products = Product::with(['category', 'suppliers'])->get();

        return view('products.index', [
            'products' => $products
        ]);
    }

    // Display one product
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', [
            'product' => $product
        ]);
    }

    // Display low stock products
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

    // Display create product form
    public function create()
    {
        $categories = Category::all();

        return view('products.create', [
            'categories' => $categories
        ]);
    }

    // Store new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product added!');
    }
}
