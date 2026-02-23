<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;

class AcademicYear extends Model
{
    use HasFactory, HasUnitIsolation;

    protected $fillable = [
        'entity_id',
        'unit_id',
        'name',
        'semester',
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