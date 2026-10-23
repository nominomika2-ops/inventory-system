<?php
namespace App\Http\Controllers;
abstract class Controller
{
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
}  //
}


