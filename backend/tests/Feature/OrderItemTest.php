<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderItemTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function it_creates_an_orderItem(): void
    {
        $response = $this->postJson('api/order-items',[
            'order_id' => 1,
            'menu_item_id' => 1,
            'quantity' => 2,
            'price' => 10.00,
        ]);
    }
    public function it_updates_an_orderItem(){
        $response = $this->putJson('api/order-items/1',[
            'quantity' => 3,
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'message' => 'Order item updated successfully',
        ]);
    }
    public function it_deletes_an_orderItem(){
        $response = $this->delete('api/order-items/1');
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'message' => 'Order item deleted successfully',
        ]);
    }
    public function it_fetches_all_orderItems_for_order(){
        $response = $this->getJson('api/orders/1/order-items');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'data' => [
                '*' => [
                    'id',
                    'order_id',
                    'menu_item_id',
                    'quantity',
                    'price',
                ],
            ],
        ]);
    }
    public function it_fetches_orderItem_by_id(){
        $response = $this->getJson('api/order-items/1');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'id',
                'order_id',
                'menu_item_id',
                'quantity',
                'price',
            ],
        ]);
    }
    public function test_example(): void
    {
        // $response = $this->get('/');

        // $response->assertStatus(200);
        $this->assertTrue(true); // Placeholder for actual test logic
    }
}
