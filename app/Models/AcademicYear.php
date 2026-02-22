<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = [
        'entity_id',
        'name',
        'is_active',
        'start_date',
        'end_date',
    ];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}