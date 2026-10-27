<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

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
    }
}