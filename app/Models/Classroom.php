<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;

class Classroom extends Model
{
    use HasUnitIsolation;
    protected $fillable = [
        'unit_id',
        'academic_year_id',
        'level',
        'name',
        'infaq_nominal',
        'wali_kelas',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function enrollments()
    {
        return $this->hasMany(StudentEnrollment::class);
    }
}