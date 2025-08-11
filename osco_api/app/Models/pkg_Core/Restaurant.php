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
        'cover_image_url',
        'phone_number',
        'phone_fix',
        'gmail',
        'address',
        'google_maps_link',

        // Social media columns (remove social_links)
        'facebook',
        'instagram',
        'youtube',
        'snapchat',
        'tiktok',

        'currency',
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
