<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;

class ReRegistration extends Model
{
    use HasUnitIsolation;
    protected $fillable = [
        'entity_id',
        'unit_id',
        'academic_year_id',
        'student_id',
        'status',
        'registration_source',
        'confirmed_by',
        'confirmed_at',
        'notes',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function confirmedByUser()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function registrationPayment()
    {
        return $this->morphOne(RegistrationPayment::class, 'registrationable');
    }
}
