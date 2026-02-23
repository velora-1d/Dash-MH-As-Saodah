<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;

use App\Models\AcademicYear;
use App\Models\GeneralTransaction;

class Payroll extends Model
{
    use HasUnitIsolation;
    protected $fillable = [
        'entity_id',
        'unit_id',
        'employee_id',
        'academic_year_id',
        'month',
        'total_earnings',
        'total_deductions',
        'net_salary',
        'payment_date',
        'status',
        'general_transaction_id',
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function details()
    {
        return $this->hasMany(PayrollDetail::class);
    }

    public function generalTransaction()
    {
        return $this->belongsTo(GeneralTransaction::class, 'general_transaction_id');
    }
}
