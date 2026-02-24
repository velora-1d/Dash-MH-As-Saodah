<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'route_name',
        'icon_svg',
        'parent_id',
        'roles',
        'order_index',
        'is_active',
        'group_name',
    ];

    protected $casts = [
        'roles' => 'array',
        'is_active' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order_index');
    }
}
