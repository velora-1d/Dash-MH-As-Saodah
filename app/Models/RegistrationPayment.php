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
        'fee_amount',
        'is_books_paid',
        'is_books_received',
        'books_amount',
        'is_uniform_paid',
        'is_uniform_received',
        'uniform_amount',
    ];

    protected $casts = [
        'is_fee_paid' => 'boolean',
        'fee_amount' => 'decimal:2',
        'is_books_paid' => 'boolean',
        'is_books_received' => 'boolean',
        'books_amount' => 'decimal:2',
        'is_uniform_paid' => 'boolean',
        'is_uniform_received' => 'boolean',
        'uniform_amount' => 'decimal:2',
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
