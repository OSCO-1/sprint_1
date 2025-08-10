<?php
namespace App\Repositories;

use App\Models\Star;
use Exception;
use Illuminate\Support\Facades\Log;

class StarRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Star());
    }
    // get all stars
    public function getAllStars()
    {
        Log::info('Fetching all stars');
        try {
            $stars = Star::with(['user', 'menuItem'])->get();
            Log::info('Stars fetched successfully', ['count' => $stars->count()]);
            return response()->json([
                'status' => 'success',
                'data' => $stars
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching stars', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch stars'
            ], 500);
        }
    }
    // get star by id
    public function getStarById($starId)
    {
        Log::info('Fetching star by ID', ['id' => $starId]);
        try {
            $star = Star::with(['menuItem', 'user'])->findOrFail($starId);
            Log::info('Star fetched successfully', ['id' => $starId]);
            return response()->json([
                'status' => 'success',
                'data' => $star
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching star', ['id' => $starId, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch star'
            ], 500);
        }
    }
    // create a new star
    public function createStar(array $data)
    {
        Log::info('Creating new star', ['data' => $data]);
        try {
            $star = Star::create($data);
            Log::info('Star created successfully', ['id' => $star->id]);
            return response()->json([
                'status' => 'success',
                'data' => $star
            ], 201);
        } catch (Exception $error) {
            Log::error('Error creating star', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create star'
            ], 500);
        }
    }
    // update an existing star
    public function updateStar($starId, array $data)
    {
        Log::info('Updating star', ['id' => $starId, 'data' => $data]);
        try {
            $star = Star::findOrFail($starId);
            $star->update($data);
            Log::info('Star updated successfully', ['id' => $starId]);
            return response()->json([
                'status' => 'success',
                'data' => $star
            ], 200);
        } catch (Exception $error) {
            Log::error('Error updating star', ['id' => $starId, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update star'
            ], 500);
        }
    }
    // delete a star
    public function deleteStar($starId)
    {
        Log::info('Deleting star', ['id' => $starId]);
        try {
            $star = Star::findOrFail($starId);
            $star->delete();
            Log::info('Star deleted successfully', ['id' => $starId]);
            return response()->json([
                'status' => 'success',
                'message' => 'Star deleted successfully'
            ], 200);
        } catch (Exception $error) {
            Log::error('Error deleting star', ['id' => $starId, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete star'
            ], 500);
        }
    }
}
