<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_name',
        'lesson_code',
        'number_unit',
    ];

    // public function students()
    // {
    //     return $this->belongsToMany(Lesson::class, 'lessons_students', 'lesson_id', 'student_id')
    //                 ->withPivot('number');
    // }

    public function students()
    {
        return $this->belongsToMany(Student::class)->withPivot('number');
    }
}
