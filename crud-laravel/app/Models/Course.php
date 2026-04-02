<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ IMPORT CORRETO
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory; // ✅ agora funciona

    protected $fillable = ['name'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}