<?php
namespace App\Repositories;

use App\Models\OrderItem;
use Exception;
use Illuminate\Support\Facades\Log;

class OrderItemRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new OrderItem());
    }
    // get all orders for restaurant
    public function getAllForOrder($orderId)
    {
        Log::info("Fetching all order items for order", ['order_id' => $orderId]);
        try {
            $orderItems = OrderItem::with(['menuItem'])
                ->where('order_id', $orderId)
                ->latest()
                ->get();
            Log::info('Order items fetched successfully', ['count' => $orderItems->count()]);
            return response()->json(['status' => 'success', 'data' => $orderItems], 200);
        } catch (Exception $error) {
            Log::error('Error fetching order items', ['error' => $error->getMessage(), 'order_id' => $orderId]);
            return response()->json(['status' => 'error', 'message' => 'Failed to fetch order items'], 500);
        }
    }
    // get order item by id
    public function getOrderItemById($id)
    {
        Log::info("Fetching order item by ID", ['order_item_id' => $id]);
        try {
            $orderItem = OrderItem::with(['menuItem'])
                ->findOrFail($id);
            Log::info('Order item fetched successfully', ['order_item_id' => $id]);
            return response()->json(['status' => 'success', 'data' => $orderItem], 200);
        } catch (Exception $error) {
            Log::error('Error fetching order item', ['error' => $error->getMessage(), 'order_item_id' => $id]);
            return response()->json(['status' => 'error', 'message' => 'Failed to fetch order item'], 500);
        }
    }
    // create new order item
    public function createOrderItem(array $data)
    {
        Log::info("Creating new order item", ['data' => $data]);
        try {
            $orderItem = OrderItem::create($data);
            Log::info('Order item created successfully', ['order_item_id' => $orderItem->id]);
            return response()->json(['status' => 'success', 'data' => $orderItem], 201);
        } catch (Exception $error) {
            Log::error('Error creating order item', ['error' => $error->getMessage(), 'data' => $data]);
            return response()->json(['status' => 'error', 'message' => 'Failed to create order item'], 500);
        }
    }
    // update order item
    public function updateOrderItem($id, array $data)
    {
        Log::info("Updating order item", ['order_item_id' => $id, 'data' => $data]);
        try {
            $orderItem = OrderItem::findOrFail($id);
            $orderItem->update($data);
            Log::info('Order item updated successfully', ['order_item_id' => $id]);
            return response()->json(['status' => 'success', 'data' => $orderItem], 200);
        } catch (Exception $error) {
            Log::error('Error updating order item', ['error' => $error->getMessage(), 'order_item_id' => $id]);
            return response()->json(['status' => 'error', 'message' => 'Failed to update order item'], 500);
        }
    }
    // delete order item
    public function deleteOrderItem($id)
    {
        Log::info("Deleting order item", ['order_item_id' => $id]);
        try {
            $orderItem = OrderItem::findOrFail($id);
            $orderItem->delete();
            Log::info('Order item deleted successfully', ['order_item_id' => $id]);
            return response()->json(['status' => 'success', 'message' => 'Order item
    deleted successfully'], 200);
        } catch (Exception $error) {
            Log::error('Error deleting order item', ['error' => $error->getMessage(), 'order_item_id' => $id]);
            return response()->json(['status' => 'error', 'message' => 'Failed to delete order item'], 500);
        }
    }
}
