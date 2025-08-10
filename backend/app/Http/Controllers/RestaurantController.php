<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantRequest;
use App\Repositories\RestaurantRepository;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $restaurantRepository;
    public function __construct(RestaurantRepository $restaurantRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
    }
    public function index()
    {
        return $this->restaurantRepository->getAllRestaurants();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantRequest $restaurantRequest)
    {
        $restaurant = $restaurantRequest->validated();
        if ($restaurantRequest->hasFile('logo')) {
            $file = $restaurantRequest->file('logo');
            $fileName = time() .'_'. $file->getClientOriginalName();
            $path = $file->storeAs('restaurants', $fileName , 'public');
            $restaurant['logo'] =$path;
        }
        return $this->restaurantRepository->createRestaurant($restaurant);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->restaurantRepository->getRestaurantById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RestaurantRequest $restaurantRequest, string $id)
    {
        $restaurant = $restaurantRequest->validated();
        if ($restaurantRequest->hasFile('logo')) {
            $file = $restaurantRequest->file('logo');
            $fileName = time() .'_'. $file->getClientOriginalName();
            $path = $file->storeAs('restaurants', $fileName , 'public');
            $restaurant['logo'] =$path;
        }
        return $this->restaurantRepository->updateRestaurant($id ,$restaurant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->restaurantRepository->deleteRestaurant($id);
    }
}
