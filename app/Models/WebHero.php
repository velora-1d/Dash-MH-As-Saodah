<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebHero extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'media_url',
        'media_type',
        'cta_text',
        'cta_url',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
