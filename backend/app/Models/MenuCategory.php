<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MenuItem;

class MenuCategory extends Model
{
    protected $fillable = ['name', 'description', 'image'];

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
