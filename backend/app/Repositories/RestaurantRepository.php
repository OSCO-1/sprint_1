<?php
namespace App\Repositories;
use App\Models\Restaurant;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class RestaurantRepository extends BaseRepository
{
    public function __construct(){
        parent::__construct(new Restaurant());
    }
    public function getAllRestaurants()
    {
        Log::info("Fetching all Restaurants");
        try {
            $restaurants = Restaurant::with(['menuCategories','menuItems','tables'])->get();
            Log::info('Restauraunts fetched successfully',['count'=>$restaurants->count()]);
            return response()->json(['status'=>'success', 'data'=>$restaurants],200);
        } catch (Exception $error) {
            Log::error( 'Error fetching restaurants', ['error' => $error->getMessage()]);
            return response()->json(['status'=>'error', 'message'=>'Failed to fetch restaurants'],500);
        }
    }
    public function getRestaurantById($id)
    {
        Log::info('Fetching restaurant by id', ['id'=>$id]);
        try {
            $restaurant = Restaurant::with(['menuCategories','menuItems','tables'])->findOrFail($id);
            Log::info('Menu item fetched successfully', ['id' => $id]);
            return response()->json(['status'=>'success', 'data'=>$restaurant],200);
        } catch (Exception $error) {
            Log::info('Error fetching resturant', ['error' => $error->getMessage()]);
            return response()->json(['status'=>'error', 'message'=>'Failed to fetch restaurant'],500);
        }
    }

    public function createRestaurant(array $data)
    {
         Log::info('Creating new restaurant', ['data' => $data]);
        try {
            $restaurant = Restaurant::create($data);
            Log::info('Restaurant created successfully', ['id' => $restaurant->id]);
            return response()->json([
                'status' => 'success',
                'data' => $restaurant
            ], 201);
        } catch (Exception $error) {
            Log::error('Error creating restaurant', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create restaurant'
            ], 500);
        }
    }

    public function updateRestaurant($id, array $data)
    {
        Log::info('Updating restaurant', ['id' => $id, 'data' => $data]);
        try {
            $restaurant = Restaurant::findOrFail($id);
            $restaurant->update($data);
            Log::info('Restaurant updated successfully', ['id' => $id]);
            return response()->json([
                'status' => 'success',
                'data' => $restaurant
            ], 200);
        } catch (Exception $error) {
            Log::error('Error updating restaurant', ['id' => $id, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update restaurant'
            ], 500);
        }
    }

    public function deleteRestaurant($id)
    {
        Log::info('Deleting restaurant', ['id' => $id]);
        try {
            $restaurant = Restaurant::findOrFail($id);
            $restaurant->delete();
            Log::info('Restaurant deleted successfully', ['id' => $id]);
            return response()->json([
                'status' => 'success',
                'message' => 'Restaurant deleted successfully'
            ], 200);
        } catch (Exception $error) {
            Log::error('Error deleting restaurant', ['id' => $id, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete restaurant'
            ], 500);
        }
    }
}
