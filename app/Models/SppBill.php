<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SppBill extends Model
{
    protected $table = 'infaq_bills';

    protected $fillable = [
        'student_id',
        'academic_year_id',
        'month',
        'nominal',
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
        return $this->hasMany(SppPayment::class, 'bill_id');
    }
}