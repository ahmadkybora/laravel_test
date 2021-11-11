<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::all('id', 'lesson_name');
        if($lessons)
            return response()->json([
                'state' => true,
                'message' => 'success',
                'data' => $lessons,
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        $studentId = $request->input('student_id');
        $number = $request->input('number');
        
        $lesson->students()->updateExistingPivot($studentId, ['number' => $number]);
        //$lesson->students()->syncWithoutDetaching($studentId, ['number' => $number]);
        // dd($lesson->id);
        // dd($request->input('lesson_id'));
        // dd($request->input('number'));
        // dd($request->input('lesson_id'));
        // $studentId = $request->input('student_id');
        // //$lessonId = $request->input('lessonId');
        // $number = $request->input('number');

        // $student = Student::findOrFail($studentId);
        // //dd($student->lessons()->attach($lessonId));
        // $student->lessons()->sync($lesson, ['number' => $number]);

        //dd($lesson);
        // $studentId = $request->input('student_id');
        // $number = $request->input('number');

        // $student = Student::findOrFail($studentId);
        // $student->lessons()->sync($lesson, ['number' => $number]);

        //$lesson->students()->sync($studentId, ['number' => $number]);
        //dd($lesson->students()->sync($studentId, ['number' => $number]));
        return response()->json([
            'state' => true,
            'message' => 'success',
            'data' => null,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Lesson $lesson)
    {
        $studentId = $request->input('student_id');
        // dd($request->all());
        // dd($lesson);
        // $student = $lesson->load('students')->toArray();
        // $s = $student['students'][0]['id'];
        //dd($s);
        $lesson->students()->detach($studentId);
        // //$lesson->delete();
        // //dd($lesson->id);
        //if($lesson->delete())
            return response()->json([
                'state' => true,
                'message' => 'success',
                'data' => null,
            ], 200);
    }
}
