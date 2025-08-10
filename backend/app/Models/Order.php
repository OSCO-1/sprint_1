<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'restaurant_id',
        'table_id',
        'total_price',
        'status',
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
