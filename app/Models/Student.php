<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasUnitIsolation;

class Student extends Model
{
    use SoftDeletes, HasUnitIsolation;
    protected $fillable = [
        'entity_id',
        'unit_id',
        'classroom_id',
        'nisn',
        'nis',
        'nik',
        'no_kk',
        'name',
        'gender',
        'category',
        'status',
        'infaq_status',
        'infaq_nominal',
        'parent_name',
        'parent_phone',
        'address',
        'entry_date',
        'admission_academic_year_id',
        'birth_place',
        'birth_date',
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

    public function sppBills()
    {
        return $this->hasMany(SppBill::class, 'student_id');
    }

    public function savingMutations()
    {
        return $this->hasMany(StudentSaving::class, 'student_id');
    }

    public function enrollments()
    {
        return $this->hasMany(StudentEnrollment::class);
    }

    public function currentEnrollment()
    {
        return $this->hasOne(StudentEnrollment::class)->whereHas('academicYear', function($q) {
            $q->where('is_active', true);
        });
    }
}