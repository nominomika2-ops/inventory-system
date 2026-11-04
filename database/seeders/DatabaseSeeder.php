<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed categories, suppliers and products
        $this->call([
            CategorySeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
        ]);

        // Create Admin User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Create Staff User
        User::factory()->create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
        ]);
    }
}