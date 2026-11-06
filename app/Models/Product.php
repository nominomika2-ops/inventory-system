<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\ProductDetail;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'stock',
        'price',
    ];

    // One Product belongs to one Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // One Product can have many Suppliers
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }

    // One Product has one Product Detail
    public function detail()
    {
        return $this->hasOne(ProductDetail::class);
    }
}
