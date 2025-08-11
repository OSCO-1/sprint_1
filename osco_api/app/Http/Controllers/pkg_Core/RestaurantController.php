<?php

namespace App\Http\Controllers\pkg_Core;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Repositories\pkg_Core\RestaurantRepository;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    protected $restaurantRepo;

    public function __construct(RestaurantRepository $restaurantRepo)
    {
        $this->restaurantRepo = $restaurantRepo;
    }

    /**
     * Display the single restaurant.
     */
    public function show()
    {
        $restaurant = $this->restaurantRepo->getRestaurant();

        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }

        return response()->json($restaurant);
    }

    /**
     * Update the single restaurant.
     */
    public function update(UpdateRestaurantRequest $request)
    {
        // The validated data is already available as $request->validated()
        $updatedRestaurant = $this->restaurantRepo->updateRestaurant($request->validated());

        return response()->json($updatedRestaurant);
    }
}
