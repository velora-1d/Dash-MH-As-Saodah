<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'entity_id',
        'unit_id',
        'classroom_id',
        'nisn',
        'name',
        'gender',
        'parent_phone',
        'entry_date',
        'status',
    ];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}