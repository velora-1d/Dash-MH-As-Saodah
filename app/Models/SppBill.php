<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;

class SppBill extends Model
{
    use HasUnitIsolation;
    protected $table = 'infaq_bills';

    protected $fillable = [
        'entity_id',
        'unit_id',
        'student_id',
        'academic_year_id',
        'month',
        'year',
        'nominal',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
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