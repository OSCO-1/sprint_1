<?php

namespace App\Models\pkg_Core;

use App\Models\pkg_Menu\MenuCategory;
use App\Models\pkg_Menu\MenuItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'headline',
        'description',
        'logo_light_theme_url',
        'logo_dark_theme_url',
        'cover_image_url',
        'phone_number',
        'address',
        'google_maps_link',
        'opening_hours',
        'social_links',
        'currency',
        'primary_color',
        'secondary_color',
        'settings',
    ];

    protected $casts = [
        'opening_hours' => 'array',
        'social_links'  => 'array',
        'settings'      => 'array',
    ];

    public function menuCategories()
    {
        return $this->hasMany(MenuCategory::class);
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
