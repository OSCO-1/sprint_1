<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemRequest;
use App\Models\Order;
use App\Repositories\OrderItemRepository;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // Construct orderItemRepository
    protected $orderItemRepository;
    public function __construct(OrderItemRepository $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($orderId)
    {
        return $this->orderItemRepository->getAllForOrder($orderId);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderItemRequest $request)
    {
        return $this->orderItemRepository->createOrderItem($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->orderItemRepository->getOrderItemById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderItemRequest $request, string $id)
    {
        return $this->orderItemRepository->updateOrderItem($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->orderItemRepository->deleteOrderItem($id);
    }
}
