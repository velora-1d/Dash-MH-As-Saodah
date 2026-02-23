<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;

class PpdbRegistration extends Model
{
    use HasUnitIsolation;
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'unit_id',
        'academic_year_id',
        'registration_number',
        'student_name',
        'gender',
        'birth_date',
        'birth_place',
        'nik',
        'no_kk',
        'parent_name',
        'parent_phone',
        'address',
        'previous_school',
        'status',
        'registration_source',
        'notes',
        'registered_at',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'registered_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
