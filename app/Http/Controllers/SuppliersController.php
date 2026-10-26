<?php
namespace App\Http\Controllers;

class SuppliersController extends Controller
{
    private $suppliers = [
        1 => [
            'id' => 1,
            'name' => 'Nomsupplier',
            'email' => 'NOMTOMsupplier@example.com',
            'phone' => '0776736218',
        ],
        2 => [
            'id' => 2,
            'name' => ' TomiGlobal',
            'email' => 'tomiglobal@example.com',
            'phone' => '0779876543',
        ],
        3 => [
            'id' => 3,
            'name' => 'City Distributors',
            'email' => 'city@example.com',
            'phone' => '0711234567',
        ],
    ];

    public function index()
    {
        $suppliers = $this->suppliers;

        return view('suppliers.index', compact('suppliers'));
    }

    public function show($id)
    {
        if (!isset($this->suppliers[$id])) {
            abort(404);
        }

        $supplier = $this->suppliers[$id];

        return view('suppliers.show', compact('supplier'));
    }
}
