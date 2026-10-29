<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Supplier;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $count = 20;

        Product::factory()
            ->count($count - 5)
            ->create();

        Product::factory()
            ->count(5)
            ->create([
                'stock' => 0,
            ]);

        $suppliers = Supplier::all();

        Product::all()->each(function ($product) use ($suppliers) {
            $product->suppliers()->attach(
                $suppliers->random(rand(1, 3))->pluck('id')
            );
        });
    }
}
