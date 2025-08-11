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

    public function updateRestaurant(array $data)
    {
        // Define all allowed fields in one array
        $allowed = [
            'name',
            'headline',
            'description',
            'logo_light_theme_url',
            'cover_image_url',
            'currency',

            'phone_number',
            'phone_fix',
            'gmail',
            'address',
            'google_maps_link',

            'facebook',
            'instagram',
            'youtube',
            'snapchat',
            'tiktok',
        ];

        // Get the restaurant or create it if missing
        $restaurant = $this->getRestaurant() ?? $this->model->create([]);

        // Filter the input data to allowed keys only
        $filteredData = array_intersect_key($data, array_flip($allowed));

        // Update the restaurant
        $restaurant->update($filteredData);

        return $restaurant->refresh();
    }
}
