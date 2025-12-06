<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'short_description',
        'description',
        'image',
        'image_alt',
        'button_text',
        'button_link',
        'custom_field',
        'position',
        'status',
    ];
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Generate Image URL
    public function getImageUrlAttribute()
    {
        return $this->image ? image_url('slider', $this->image, 'medium') : null;
    }
}
