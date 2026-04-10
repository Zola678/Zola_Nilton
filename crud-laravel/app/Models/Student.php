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
        'course_id',
        'phone',
        'birth_date',
        'photo',
        'course'

    ];

    // transforma birth_date em Carbon automaticamente
    protected $casts = [
        'birth_date' => 'datetime',
    ];

    // Relacionamento com course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}