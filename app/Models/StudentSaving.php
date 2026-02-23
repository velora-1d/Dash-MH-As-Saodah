<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;

class StudentSaving extends Model
{
    use HasUnitIsolation;
    protected $table = 'student_savings_mutations';

    protected $fillable = [
        'entity_id',
        'unit_id',
        'student_id',
        'type',
        'amount',
        'date',
        'description',
        'status',
        'user_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope aktif (tidak void)
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Hitung saldo siswa berdasarkan mutasi aktif
    public static function getBalance(int $studentId): float
    {
        $in = self::where('student_id', $studentId)->active()->where('type', 'in')->sum('amount');
        $out = self::where('student_id', $studentId)->active()->where('type', 'out')->sum('amount');
        return $in - $out;
    }
}