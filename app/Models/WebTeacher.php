<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebTeacher extends Model
{
    protected $fillable = [
        'name',
        'position',
        'photo_url',
        'bio',
        'order',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true)->orderBy('order');
    }
}
