<?php

namespace App\Models\pkg_Menu;

use App\Models\pkg_Core\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model
{
    use HasTranslations;

    protected $fillable = [
        'restaurant_id',
        'menu_category_id',
        'name',
        'description',
        'image_url',
        'base_price',
        'is_available'
    ];

    public $translatable = ['name', 'description'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function menuCategory()
    {
        return $this->belongsTo(MenuCategory::class);
    }
}
