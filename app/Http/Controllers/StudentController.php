<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with(['lessons' => function ($query) {
            $query->select(
                'id', 
                'lesson_code', 
                'lesson_name', 
                'units', 
                'lesson_id', 
                'student_id', 
                'score'
            );
        }])
        ->withSum('lessons as total_units', 'units')
        ->get();

        foreach($students as $index => $student)
        {
            foreach($students[$index]->lessons as $i => $s){
                if($students[$index]->id == $students[$index]->lessons[$i]->student_id)
                    $students[$index]->total_number_units += ( $students[$index]->lessons[$i]->units * $students[$index]->lessons[$i]->score );
            }
        }

        if($students)
            return response()->json([
                'state' => true,
                'message' => 'success',
                'data' => $students,
            ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request, Student $student)
    {
        $lessonId = Lesson::find($request->input('lessonId'));
        $score = $request->input('score');

        if($student->lessons->contains($lessonId))
            return response()->json([
                'state' => true,
                'message' => 'Please see the score editing section',
                'data' => null,
            ], 201);

        if(!$student->lessons->contains($lessonId))
            $student->lessons()->attach($lessonId, ['score' => $score]);

        return response()->json([
            'state' => true,
            'message' => 'success',
            'data' => null,
        ], 200);
    }
}
