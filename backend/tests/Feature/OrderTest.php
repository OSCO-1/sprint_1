<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function it_creates_an_order(){
        $user = User::factory()->create();
        // Here you can add logic to create an order for the user
        $response = $this->actingAs($user)->postJson('api/orders', [
            'table_id' => 1,
            'restaurant_id' => 1,
            'total_price' => 100.00,
            'status' => 'pending',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $response->assertStatus(201);
    }

    public function test_example(): void
    {
        // $response = $this->get('/');

        // $response->assertStatus(200);
        $this->assertTrue(true); // Placeholder for actual test logic
    }
}
