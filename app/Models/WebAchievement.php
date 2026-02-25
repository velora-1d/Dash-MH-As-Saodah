<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebAchievement extends Model
{
    protected $fillable = [
        'title',
        'competition_name',
        'level',
        'student_name',
        'year',
        'image_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderByDesc('year');
    }
}
