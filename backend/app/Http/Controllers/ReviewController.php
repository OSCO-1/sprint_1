<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Repositories\ReviewRepository;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->reviewRepository->getAllReviews();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    {
        $review = $request->validated();
        return $this->reviewRepository->createReview($review);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->reviewRepository->getReviewById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, string $id)
    {
        $review = $request->validated();
        return $this->reviewRepository->updateReview($id, $review);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->reviewRepository->deleteReview($id);
    }
}
