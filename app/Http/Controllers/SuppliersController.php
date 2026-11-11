<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSupplierRequest;

class SuppliersController extends Controller
{
    // Display suppliers with search, city filter and pagination
    public function index(Request $request)
    {
        $query = Supplier::query();

        // Search by supplier name or city
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('city', 'like', '%' . $search . '%');
            });
        }

        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // Get suppliers with pagination
        $suppliers = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        // Get available cities for dropdown
        $cities = Supplier::whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        return view('suppliers.index', compact('suppliers', 'cities'));
    }

    // Show create supplier form
    public function create()
    {
        return view('suppliers.create');
    }

    // Store new supplier
    public function store(StoreSupplierRequest $request)
    {
        Supplier::create($request->validated());

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier added!');
    }

    // Display single supplier
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.show', compact('supplier'));
    }
}
