<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'course',
        'phone',
        'birth_date'
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'birth_date' => 'date',
    ];
}