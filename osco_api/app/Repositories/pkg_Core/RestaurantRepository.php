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
     * Update basic info: name, headline, description, logo_light_theme_url, cover_image_url, currency
     *
     * @param array $data
     * @return Restaurant
     */
    public function updateBasicInfo(array $data)
    {
        $allowed = ['name', 'headline', 'description', 'logo_light_theme_url', 'cover_image_url', 'currency'];

        $restaurant = $this->getRestaurant();

        $restaurant->update(array_intersect_key($data, array_flip($allowed)));

        return $restaurant;
    }

    /**
     * Update contact info: phone_number, phone_fix, gmail, address, google_maps_link
     *
     * @param array $data
     * @return Restaurant
     */
    public function updateContactInfo(array $data)
    {
        $allowed = ['phone_number', 'phone_fix', 'gmail', 'address', 'google_maps_link'];

        $restaurant = $this->getRestaurant();

        $restaurant->update(array_intersect_key($data, array_flip($allowed)));

        return $restaurant;
    }

    /**
     * Update opening hours (expects JSON or array)
     *
     * @param array|string $openingHours
     * @return Restaurant
     */
    public function updateOpeningHours($openingHours)
    {
        $restaurant = $this->getRestaurant();

        // If array given, convert to JSON
        if (is_array($openingHours)) {
            $openingHours = json_encode($openingHours);
        }

        $restaurant->opening_hours = $openingHours;
        $restaurant->save();

        return $restaurant;
    }

    /**
     * Update social links (expects JSON or array)
     *
     * @param array|string $socialLinks
     * @return Restaurant
     */
    public function updateSocialLinks($socialLinks)
    {
        $restaurant = $this->getRestaurant();

        // If array given, convert to JSON
        if (is_array($socialLinks)) {
            $socialLinks = json_encode($socialLinks);
        }

        $restaurant->social_links = $socialLinks;
        $restaurant->save();

        return $restaurant;
    }
}
