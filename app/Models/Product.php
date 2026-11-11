<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'stock',
        'price',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }

    public function detail()
    {
        return $this->hasOne(ProductDetail::class);
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class)->latest();
    }
}
