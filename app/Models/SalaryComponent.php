<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryComponent extends Model
{
    protected $fillable = [
        'name',
        'type',
    ];

    public function employeeSalaries()
    {
        return $this->hasMany(EmployeeSalary::class);
    }
}
