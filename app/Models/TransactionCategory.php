<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionCategory extends Model
{
    protected $fillable = [
        'entity_id',
        'type',
        'name',
        'is_active',
    ];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}