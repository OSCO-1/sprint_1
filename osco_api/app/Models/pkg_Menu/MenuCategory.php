<?php

namespace App\Models\pkg_Menu;

use App\Models\pkg_Core\Restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MenuCategory extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'image_url',
        'display_order',
    ];

    public $translatable = ['name', 'description'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
