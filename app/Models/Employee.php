<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasUnitIsolation;
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'entity_id',
        'unit_id',
        'user_id',
        'nip',
        'name',
        'type',
        'position',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke pengaturan gaji baku pegawai (pivot ke SalaryComponent).
     */
    public function salaryComponents()
    {
        return $this->hasMany(\App\Models\EmployeeSalary::class);
    }

    /**
     * Relasi ke riwayat slip gaji (payroll) yang pernah diterbitkan.
     */
    public function payrolls()
    {
        return $this->hasMany(\App\Models\Payroll::class);
    }
}