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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        if(!$student->lessons->contains($lessonId))
            $student->lessons()->attach($lessonId, ['score' => $score]);

        foreach($student->lessons as $index => $s)
        {
            if(($student->lessons[$index]->pivot->lesson_id == $lessonId->id and $lessonId->students[$index]->pivot->student_id == $student->id))
                $student->lessons()->updateExistingPivot($lessonId, ['number' => $score], false);
        }

        return response()->json([
            'state' => true,
            'message' => 'success',
            'data' => null,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //dd($student->lessons);

        //$lesson = Lesson::find();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $lessonId = Lesson::find($request->input('lessonId'));
        $score = $request->input('score');

        if(!$student->lessons->contains($lessonId))
            $student->lessons()->attach($lessonId, ['score' => $score]);

        foreach($student->lessons as $index => $s)
        {
            if(($student->lessons[$index]->pivot->lesson_id == $lessonId->id and $lessonId->students[$index]->pivot->student_id == $student->id))
                $student->lessons()->updateExistingPivot($lessonId, ['score' => $score], false);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
