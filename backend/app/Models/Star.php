<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    protected $fillable = ['user_id', 'menu_item_id', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
