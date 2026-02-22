<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SppBill extends Model
{
    protected $fillable = [
        'student_id',
        'unit_id',
        'academic_year_id',
        'month_period',
        'amount',
        'paid_amount',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
    public function payments()
    {
        return $this->hasMany(SppPayment::class);
    }
}