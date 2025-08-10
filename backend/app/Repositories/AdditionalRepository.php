<?php
namespace App\Repositories;

use App\Models\Additional;
use Exception;
use Illuminate\Support\Facades\Log;

class AdditionalRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Additional());
    }
    // get all additional items
    public function getAllAdditionalItems()
    {
        Log::info('Fetching all additional items');
        try {
            $additionals = Additional::with(['restaurant', 'menuItem'])->get();
            Log::info('Additional items fetched successfully',['count' => $additionals->count()]);
            return response()->json([
                'status' => 'success',
                'data' => $additionals
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching additional items', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch additional items'
            ], 500);
        }
    }
    // get additional item by id
    public function getAdditionalItemById($additionalId)
    {
        Log::info('Fetching additional item by ID', ['id' => $additionalId]);
        try {
            $additional = Additional::with(['restaurant', 'menuItem'])->findOrFail($additionalId);
            Log::info('Additional item fetched successfully', ['id' => $additionalId]);
            return response()->json([
                'status' => 'success',
                'data' => $additional
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching additional item', ['id' => $additionalId, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch additional item'
            ], 500);
        }
    }
    // get paginated additional items
    public function getPaginatedAdditionalItems($perPage = 7)
    {
        Log::info('Fetching paginated additional items');
        try {
            $additionals = Additional::with(['restaurant', 'menuItem'])->paginate($perPage);
            Log::info('Paginated additional items fetched successfully', ['count' => $additionals->count()]);
            return response()->json([
                'status' => 'success',
                'data' => $additionals
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching paginated additional items', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch paginated additional items'
            ], 500);
        }
    }
    // create a new additional item
    public function createAdditionalItem(array $data)
    {
        Log::info('Creating new additional item', ['data' => $data]);
        try {
            $additional = Additional::create($data);
            Log::info('Additional item created successfully', ['id' => $additional->id]);
            return response()->json([
                'status' => 'success',
                'data' => $additional
            ], 201);
        } catch (Exception $error) {
            Log::error('Error creating additional item', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create additional item'
            ], 500);
        }
    }
    // update an existing additional item
    public function updateAdditionalItem($additionalId, array $data)
    {
        Log::info('Updating additional item', ['id' => $additionalId, 'data' => $data]);
        try {
            $additional = Additional::findOrFail($additionalId);
            $additional->update($data);
            Log::info('Additional item updated successfully', ['id' => $additional->id]);
            return response()->json([
                'status' => 'success',
                'data' => $additional
            ], 200);
        } catch (Exception $error) {
            Log::error('Error updating additional item', ['id' => $additionalId, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update additional item'
            ], 500);
        }
    }
    // delete an additional item
    public function deleteAdditionalItem($additionalId)
    {
        Log::info('Deleting additional item', ['id' => $additionalId]);
        try {
            $additional = Additional::findOrFail($additionalId);
            $additional->delete();
            Log::info('Additional item deleted successfully', ['id' => $additionalId]);
            return response()->json([
                'status' => 'success',
                'message' => 'Additional item deleted successfully'
            ], 200);
        } catch (Exception $error) {
            Log::error('Error deleting additional item', ['id' => $additionalId, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete additional item'
            ], 500);
        }
    }
    // search additional items by name
    public function searchAdditionalItems($query)
    {
        Log::info('Searching additional items', ['query' => $query]);
        try {
            $additionals = Additional::with(['restaurant', 'menuItem'])
                ->where('name', 'like', '%' . $query . '%')
                ->orWhereHas('restaurant', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                })
                ->orWhereHas('menuItem', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                })
                ->get();
            Log::info('Additional items searched successfully', ['count' => $additionals->count()]);
            return response()->json([
                'status' => 'success',
                'data' => $additionals
            ], 200);
        } catch (Exception $error) {
            Log::error('Error searching additional items', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to search additional items'
            ], 500);
            }
    }
}
