<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Xogtan haddii aysan halkan ku jirin, DB-ga ma galayso
    protected $fillable = [
        'student_id',
        'name',
        'email',
        'gender',
        'class_level',
        'date_of_birth',
        'parent_phone',
        'address'
    ];
}