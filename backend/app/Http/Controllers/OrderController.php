<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Construct orderRepository
    protected $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $restaurantId = $request->input('restaurant_id');
        return $this->orderRepository->getAllForRestaurant($restaurantId);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        return $this->orderRepository->createOrder($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->orderRepository->getOrderById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, string $id)
    {
        return $this->orderRepository->updateOrder($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->orderRepository->deleteOrder($id);
    }
}
