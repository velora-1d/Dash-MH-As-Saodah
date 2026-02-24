<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;

class PpdbRegistration extends Model
{
    use HasUnitIsolation;
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'unit_id',
        'academic_year_id',
        'registration_number',
        'student_name',
        'gender',
        'birth_date',
        'birth_place',
        'nik',
        'no_kk',
        'parent_name',
        'parent_phone',
        'address',
        'previous_school',
        'status',
        'registration_source',
        'notes',
        'registered_at',
        'reviewed_by',
        'reviewed_at',
        'family_status',
        'sibling_count',
        'child_position',
        'religion',
        'village',
        'district',
        'residence_type',
        'transportation',
        'student_phone',
        'height',
        'weight',
        'distance_to_school',
        'travel_time',
        'father_name',
        'father_birth_place',
        'father_birth_date',
        'father_nik',
        'father_education',
        'father_occupation',
        'mother_name',
        'mother_birth_place',
        'mother_birth_date',
        'mother_nik',
        'mother_education',
        'mother_occupation',
        'parent_income',
        'guardian_name',
        'guardian_birth_place',
        'guardian_birth_date',
        'guardian_nik',
        'guardian_education',
        'guardian_occupation',
        'guardian_address',
        'guardian_phone',
        'attachments',
    ];

    protected $casts = [
        'attachments' => 'array',
        'birth_date' => 'date',
        'father_birth_date' => 'date',
        'mother_birth_date' => 'date',
        'guardian_birth_date' => 'date',
        'registered_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function registrationPayment()
    {
        return $this->morphOne(RegistrationPayment::class, 'registrationable');
    }
}
