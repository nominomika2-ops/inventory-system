<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    // Display products with search, filter and pagination
    public function index(Request $request)
    {
        $query = Product::with(['category', 'suppliers']);

        // Search by product name
        if ($request->filled('search')) {
            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by stock status
        if ($request->stock === 'low') {
            $query->where(
                'stock',
                '<',
                config('inventory.low_stock_limit')
            );
        } elseif ($request->stock === 'out') {
            $query->where('stock', 0);
        }

        // Pagination
        $products = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        // Get categories for dropdown
        $categories = Category::orderBy('name')->get();

        return view('products.index', compact(
            'products',
            'categories'
        ));
    }

    // Show create product form
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('products.create', compact(
            'categories',
            'suppliers'
        ));
    }

    // Store new product with image and suppliers
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        $suppliers = $data['suppliers'] ?? [];
        unset($data['suppliers']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('products', 'public');
        }

        $product = Product::create($data);

        $product->suppliers()->sync($suppliers);

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

    // Display single product with stock movement history
    public function show($id)
    {
        $product = Product::with([
            'category',
            'suppliers',
            'detail',
            'stockMovements.user'
        ])->findOrFail($id);

        return view('products.show', compact('product'));
    }

    // Show edit product form
    public function edit($id)
    {
        return view('products.edit', [
            'product' => Product::with('suppliers')->findOrFail($id),
            'categories' => Category::orderBy('name')->get(),
            'suppliers' => Supplier::orderBy('name')->get(),
        ]);
    }

    // Update product
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validated();

        $suppliers = $data['suppliers'] ?? [];
        unset($data['suppliers']);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')
                ->store('products', 'public');
        }

        $product->update($data);

        $product->suppliers()->sync($suppliers);

        return redirect()
            ->route('products.show', $product->id)
            ->with('success', 'Product updated!');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->detail()->delete();
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted!');
    }
}
