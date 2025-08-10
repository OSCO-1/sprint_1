<?php
namespace App\Repositories;

use App\Models\Review;
use Exception;
use Illuminate\Support\Facades\Log;

class ReviewRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Review());
    }

    // get all reviews
    public function getAllReviews()
    {
        Log::info('Fetching all reviews');
        try {
            $reviews = Review::with(['restaurant', 'user'])->get();
            Log::info('Reviews fetched successfully', ['count' => $reviews->count()]);
            return response()->json([
                'status' => 'success',
                'data' => $reviews
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching reviews', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch reviews'
            ], 500);
        }
    }
    // get paginated reviews
    public function getPaginatedReviews($perPage = 7)
    {
        Log::info('Fetching paginated reviews');
        try {
            $reviews = Review::with(['restaurant', 'user', 'order'])->paginate($perPage);
            Log::info('Paginated reviews fetched successfully', ['count' => $reviews->count()]);
            return response()->json([
                'status' => 'success',
                'data' => $reviews
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching paginated reviews', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch paginated reviews'
            ], 500);
        }
    }

    // get review by id
    public function getReviewById($reviewId)
    {
        Log::info('Fetching review by ID', ['id' => $reviewId]);
        try {
            $review = Review::with(['restaurant', 'user', 'order'])->findOrFail($reviewId);
            Log::info('Review fetched successfully', ['id' => $reviewId]);
            return response()->json([
                'status' => 'success',
                'data' => $review
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching review', ['id' => $reviewId, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch review'
            ], 500);
        }
    }
    // create a new review
    public function createReview(array $data)
    {
        Log::info('Creating new review', ['data' => $data]);
        try {
            $review = Review::create($data);
            Log::info('Review created successfully', ['id' => $review->id]);
            return response()->json([
                'status' => 'success',
                'data' => $review
            ], 201);
        } catch (Exception $error) {
            Log::error('Error creating review', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create review'
            ], 500);
        }
    }
    // update a review
    public function updateReview($reviewId, array $data)
    {
        Log::info('Updating review', ['id' => $reviewId, 'data' => $data]);
        try {
            $review = Review::findOrFail($reviewId);
            $review->update($data);
            Log::info('Review updated successfully', ['id' => $reviewId]);
            return response()->json([
                'status' => 'success',
                'data' => $review
            ], 200);
        } catch (Exception $error) {
            Log::error('Error updating review', ['id' => $reviewId, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update review'
            ], 500);
        }
    }
    // delete a review
    public function deleteReview($reviewId)
    {
        Log::info('Deleting review', ['id' => $reviewId]);
        try {
            $review = Review::findOrFail($reviewId);
            $review->delete();
            Log::info('Review deleted successfully', ['id' => $reviewId]);
            return response()->json([
                'status' => 'success',
                'message' => 'Review deleted successfully'
            ], 200);
        } catch (Exception $error) {
            Log::error('Error deleting review', ['id' => $reviewId, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete review'
            ], 500);
        }
    }

}
