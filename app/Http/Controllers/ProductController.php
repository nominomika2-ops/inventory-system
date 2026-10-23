<?php
namespace App\Http\Controllers;
class ProductController extends Controller
{
    private function getProducts()
    {
        return [
            1 => ['id' => 1, 'name' => 'Pen', 'stock' => 100],
            2 => ['id' => 2, 'name' => 'Notebook', 'stock' => 50],
            3 => ['id' => 3, 'name' => 'Stapler', 'stock' => 20],
        ];
    }

    public function index()
{
    $products = $this->getProducts();

    return view('products.index', ['products' => $products]);
}

public function show($id)
{
    $products = $this->getProducts();

    if (!isset($products[$id])) {
        abort(404);
    }

    return view('products.show', ['product' => $products[$id]]);
}
}

