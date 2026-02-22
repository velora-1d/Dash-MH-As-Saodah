<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id',
        'entity_id',
        'unit_id',
        'action_type',
        'resource_type',
        'resource_id',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}