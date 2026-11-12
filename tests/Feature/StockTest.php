<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockTest extends TestCase
{
    use RefreshDatabase;

    public function test_staff_can_stock_in(): void
    {
        $staff = User::factory()->create([
            'role' => 'staff',
        ]);

        $product = Product::factory()->create([
            'stock' => 10,
        ]);

        $response = $this->actingAs($staff)->post(
            url('/products/' . $product->id . '/stock'),
            [
                'type' => 'in',
                'quantity' => 5,
                'note' => 'New stock',
            ]
        );

        $product->refresh();

        $this->assertEquals(15, $product->stock);

        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'user_id' => $staff->id,
            'type' => 'in',
            'quantity' => 5,
        ]);

        $response->assertSessionHas('success');
    }

    public function test_staff_can_stock_out(): void
    {
        $staff = User::factory()->create([
            'role' => 'staff',
        ]);

        $product = Product::factory()->create([
            'stock' => 20,
        ]);

        $response = $this->actingAs($staff)->post(
            url('/products/' . $product->id . '/stock'),
            [
                'type' => 'out',
                'quantity' => 5,
                'note' => 'Sold items',
            ]
        );

        $product->refresh();

        $this->assertEquals(15, $product->stock);

        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'user_id' => $staff->id,
            'type' => 'out',
            'quantity' => 5,
        ]);

        $response->assertSessionHas('success');
    }

    public function test_stock_out_cannot_exceed_available_stock(): void
    {
        $staff = User::factory()->create([
            'role' => 'staff',
        ]);

        $product = Product::factory()->create([
            'stock' => 5,
        ]);

        $response = $this->actingAs($staff)->post(
            url('/products/' . $product->id . '/stock'),
            [
                'type' => 'out',
                'quantity' => 10,
                'note' => 'Test insufficient stock',
            ]
        );

        $response->assertSessionHasErrors('quantity');

        $product->refresh();

        $this->assertEquals(5, $product->stock);

        $this->assertDatabaseMissing('stock_movements', [
            'product_id' => $product->id,
            'type' => 'out',
            'quantity' => 10,
        ]);
    }
}
