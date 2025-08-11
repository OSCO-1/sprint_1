<?php

namespace App\Http\Controllers\pkg_Core;

use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_Core\UpdateRestaurantRequest; // New unified request
use App\Repositories\pkg_Core\RestaurantRepository;
use Illuminate\Http\JsonResponse;

class RestaurantController extends Controller
{
    protected RestaurantRepository $restaurantRepo;

    public function __construct(RestaurantRepository $restaurantRepo)
    {
        $this->restaurantRepo = $restaurantRepo;
    }

    /**
     * Display the single restaurant.
     */
    public function show(): JsonResponse
    {
        $restaurant = $this->restaurantRepo->getRestaurant();

        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }

        return response()->json($restaurant);
    }

    /**
     * Update all restaurant info at once (basic, contact, social)
     */
    public function update(UpdateRestaurantRequest $request): JsonResponse
    {
        $data = $request->validated();

        $restaurant = $this->restaurantRepo->updateRestaurant($data);

        return response()->json($restaurant);
    }
}
