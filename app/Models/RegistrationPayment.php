<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;

class RegistrationPayment extends Model
{
    use HasUnitIsolation;

    protected $fillable = [
        'entity_id',
        'unit_id',
        'academic_year_id',
        'registrationable_type',
        'registrationable_id',
        'is_fee_paid',
        'is_books_paid',
        'is_books_received',
        'is_uniform_paid',
        'is_uniform_received',
    ];

    protected $casts = [
        'is_fee_paid' => 'boolean',
        'is_books_paid' => 'boolean',
        'is_books_received' => 'boolean',
        'is_uniform_paid' => 'boolean',
        'is_uniform_received' => 'boolean',
    ];

    /**
     * Relasi polimorfik ke PpdbRegistration atau ReRegistration.
     */
    public function registrationable()
    {
        return $this->morphTo();
    }

    /**
     * Relasi ke tahun ajaran.
     */
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
