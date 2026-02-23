<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolSetting extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'logo_path',
        'headmaster_name',
        'headmaster_nip'
    ];
}
