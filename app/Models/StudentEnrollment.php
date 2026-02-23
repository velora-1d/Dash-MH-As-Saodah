<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;

class StudentEnrollment extends Model
{
    use HasUnitIsolation;

    protected $fillable = [
        'entity_id',
        'unit_id',
        'student_id',
        'classroom_id',
        'academic_year_id',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
