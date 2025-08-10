<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    protected $fillable = ['restaurant_id', 'menu_item_id', 'name', 'price', 'available'];

    // Additional methods and relationships can be defined here as needed
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
