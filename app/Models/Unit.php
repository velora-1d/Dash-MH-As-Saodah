<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['entity_id', 'name'];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}