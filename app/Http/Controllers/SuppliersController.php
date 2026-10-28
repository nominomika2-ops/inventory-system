<?php

namespace App\Http\Controllers;

use App\Models\Supplier;

class SuppliersController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();

        return view('suppliers.index', compact('suppliers'));
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.show', compact('supplier'));
    }
}
