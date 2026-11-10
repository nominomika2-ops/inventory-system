<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\StockMovement;

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

    public function adjust(Request $request, $id)
    {
        $validated = $request->validate([
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($id, $validated, $request) {

            $product = Product::where('id', $id)
                ->lockForUpdate()
                ->firstOrFail();

            if (
                $validated['type'] === 'out' &&
                $validated['quantity'] > $product->stock
            ) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'quantity' => 'Not enough stock available.'
                ]);
            }

            if ($validated['type'] === 'in') {
                $product->increment('stock', $validated['quantity']);
            } else {
                $product->decrement('stock', $validated['quantity']);
            }

            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => $request->user()->id,
                'type' => $validated['type'],
                'quantity' => $validated['quantity'],
                'note' => $validated['note'] ?? null,
            ]);
        });

        return back()->with('success', 'Stock updated successfully!');
    }
}
