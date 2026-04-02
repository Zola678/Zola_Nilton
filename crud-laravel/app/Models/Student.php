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
        'phone',
        'birth_date',
        'course_id', // agora é course_id
    ];

    protected $dates = ['deleted_at' , 'birth_date'];

    // Relacionamento
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}