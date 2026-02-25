<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebFacility extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_url',
        'icon_svg',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
