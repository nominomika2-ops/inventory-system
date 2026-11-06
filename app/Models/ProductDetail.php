<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductDetail extends Model
{
    protected $fillable = [
        'product_id',
        'barcode',
        'description',
    ];

    // Product Detail belongs to one Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
