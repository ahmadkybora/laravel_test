<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'student_code',
        'national_code',
    ];

    // public function lessons()
    // {
    //     return $this->belongsToMany(Lesson::class, 'lessons_students', 'student_id', 'lesson_id')
    //                 ->withPivot('number');
    // }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)->withPivot('number');
    }
}
