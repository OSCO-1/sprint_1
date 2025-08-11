<?php

namespace App\Repositories\pkg_Core;

use App\Models\pkg_Core\Restaurant;
use App\Repositories\BaseRepository;

class RestaurantRepository extends BaseRepository
{
    public function __construct(Restaurant $restaurant)
    {
        parent::__construct($restaurant);
    }

    /**
     * Get the single restaurant record
     */
    public function getRestaurant()
    {
        return $this->model->first(); // Assumes only one restaurant record exists
    }

    /**
     * Update the restaurant data
     * @param array $data
     * @return Restaurant
     */
    public function updateRestaurant(array $data)
    {
        $restaurant = $this->getRestaurant();

        $restaurant->update($data);

        return $restaurant;
    }
}
