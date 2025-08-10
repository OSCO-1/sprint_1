<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image', 'menu_category_id', 'restaurant_id'];

    public function menuCategory()
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
