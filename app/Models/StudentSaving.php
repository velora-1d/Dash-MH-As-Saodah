<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSaving extends Model
{
    protected $fillable = [
        'student_id',
        'unit_id',
        'cash_account_id',
        'user_id',
        'type',
        'amount',
        'transaction_date',
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
    public function cashAccount()
    {
        return $this->belongsTo(CashAccount::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}