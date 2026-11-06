<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    // Display all products
    public function index()
    {
        $products = Product::with(['category', 'suppliers'])->get();

        return view('products.index', compact('products'));
    }

    // Show create product form
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    // Store new product
    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()->route('products.index')
            ->with('success', 'Product added successfully!');
    }

    // Display low stock products
    public function lowStock()
    {
        $products = DB::table('products')
            ->where('stock', '<', config('inventory.low_stock_limit'))
            ->orderBy('stock')
            ->get();

        return view('products.low-stock', compact('products'));
    }

    // Display single product
    public function show($id)
    {
        $product = Product::with([
            'category',
            'suppliers',
            'detail'
        ])->findOrFail($id);

        return view('products.show', compact('product'));
    }
}