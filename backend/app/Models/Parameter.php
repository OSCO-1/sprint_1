<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $fillable = ['restaurant_id', 'parameter_type', 'name', 'description', 'primary_color', 'secondary_color', 'background_color', 'text_color', 'font_family', 'font_size', 'logo_position', 'menu_layout', 'button_style', 'theme_mode', 'custom_css', 'is_active'];

    // Define relationships if needed
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
