<?php
namespace App\Repositories;

use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Log;

class OrderRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Order());
    }
    
    // get all orders for restaurant
    public function getAllForRestaurant($restaurantId)
    {
        Log::info("Fetching all orders for restaurant", ['restaurant_id' => $restaurantId]);
        try {
            $orders = Order::with(['orderItems.menuItem', 'table'])
               ->where('restaurant_id', $restaurantId)
               ->latest()
               ->get();
            Log::info('Orders fetched successfully', ['count' => $orders->count()]);
            return response()->json(['status' => 'success', 'data' => $orders], 200);
        }
        catch (Exception $error) {
            Log::error('Error fetching orders', ['error' => $error->getMessage()]);
            return response()->json(['status' => 'error', 'message' => 'Failed to fetch orders'], 500);
        }
    }
    // get order by id
    public function getOrderById($id)
    {
        Log::info("Fetching order by ID", ['order_id' => $id]);
        try {
            $order = Order::with(['orderItems.menuItem', 'table'])
            ->findOrFail($id);
            Log::info('Order fetched successfully', ['order_id' => $id]);
            return response()->json(['status' => 'success', 'data' => $order], 200);
        } catch (Exception $error) {
            Log::error('Error fetching order', ['error' => $error->getMessage(), 'order_id' => $id]);
            return response()->json(['status' => 'error', 'message' => 'Failed to fetch order'], 500);
        }
    }
    // create new order
    public function createOrder(array $data)
    {
        Log::info("Creating new order", ['data' => $data]);
        try {
            $order = Order::create($data);
            Log::info('Order created successfully', ['order_id' => $order->id]);
            return response()->json(['status' => 'success', 'data' => $order], 201);
        } catch (Exception $error) {
            Log::error('Error creating order', ['error' => $error->getMessage(), 'data' => $data]);
            return response()->json(['status' => 'error', 'message' => 'Failed to create order'], 500);
        }
    }
    // update order
    public function updateOrder($id, array $data)
    {
        Log::info("Updating the order",['order_id'=>$id , 'data'=>$data]);
        try {
            $order = Order::findOrFail($id);
            $order->update($data);
            Log::info("Order updated successfuly", ['order_id' => $id , 'data'=>$data]);
            return response()->json(['status' => 'success', 'data' => $order], 201);
        } catch (Exception $error) {
            Log::error('Error updating order', ['error' => $error->getMessage(), 'data' => $data]);
            return response()->json(['status' => 'error', 'message' => 'Failed to create order'], 500);
        }
    }
    // delete order
    public function deleteOrder($id)
    {
        Log::info("Deleting the order", ['order_id' => $id]);
        try {
            $order = Order::findOrFail($id);
            $order->delete();

            Log::info("Order deleted successfully", ['order_id' => $id]);
            return response()->json(['status' => 'success', 'message' => 'Order deleted'], 200);
        } catch (Exception $error) {
            Log::error('Error deleting order', ['error' => $error->getMessage(), 'order_id' => $id]);
            return response()->json(['status' => 'error', 'message' => 'Failed to delete order'], 500);
        }
    }

}
