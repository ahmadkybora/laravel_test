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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        $studentId = Student::find($request->input('student_id'));
        $score = $request->input('score');
        
        $lesson->students()->updateExistingPivot($studentId->id, ['score' => $score]);

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
        $studentId = Student::find($request->input('student_id'));

        $lesson->students()->detach($studentId->id);
        return response()->json([
            'state' => true,
            'message' => 'success',
            'data' => null,
        ], 200);
    }
}
