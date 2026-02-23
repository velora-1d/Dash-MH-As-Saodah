<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
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
}