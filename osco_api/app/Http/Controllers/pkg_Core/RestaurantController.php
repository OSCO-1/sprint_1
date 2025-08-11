<?php

namespace App\Http\Controllers\pkg_Core;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBasicInfoRequest;
use App\Http\Requests\UpdateContactInfoRequest;
use App\Http\Requests\UpdateOpeningHoursRequest;
use App\Http\Requests\UpdateSocialLinksRequest;
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
     * Update basic info: name, headline, description, logo_light_theme_url, cover_image_url, currency
     */
    public function updateBasicInfo(UpdateBasicInfoRequest $request): JsonResponse
    {
        $restaurant = $this->restaurantRepo->updateBasicInfo($request->validated());

        return response()->json($restaurant);
    }

    /**
     * Update contact info: phone_number, phone_fix, gmail, address, google_maps_link
     */
    public function updateContactInfo(UpdateContactInfoRequest $request): JsonResponse
    {
        $restaurant = $this->restaurantRepo->updateContactInfo($request->validated());

        return response()->json($restaurant);
    }

    /**
     * Update opening hours (expects JSON or array)
     */
    public function updateOpeningHours(UpdateOpeningHoursRequest $request): JsonResponse
    {
        $restaurant = $this->restaurantRepo->updateOpeningHours($request->validated()['opening_hours']);

        return response()->json($restaurant);
    }

    /**
     * Update social links (expects JSON or array)
     */
    public function updateSocialLinks(UpdateSocialLinksRequest $request): JsonResponse
    {
        $restaurant = $this->restaurantRepo->updateSocialLinks($request->validated()['social_links']);

        return response()->json($restaurant);
    }
}
