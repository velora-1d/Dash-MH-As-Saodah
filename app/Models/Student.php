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