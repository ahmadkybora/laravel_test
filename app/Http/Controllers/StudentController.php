<?php

namespace App\Http\Controllers;

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
            $query->select('*');
        }])
            ->withSum('lessons as total_unit', 'number_unit')
            ->withSum('lessons as total_number', 'number_unit')->get();

        //$students = Student::find(1)->lessons->sum('pivot.number');
        // $students = Student::with('lessons')
        // ->withSum('lessons as total_unit', 'number_unit')
        // ->withSum('lessons as total_number', 'number_unit')->get();

//         $students = Student::withSum('lessons.pivot', 'number')->get(); 
// dd($students);
//         foreach ($students as $student) {
//         echo $student->comments_sum_votes;
//         }
        //$students = Student::with('lessons')->sum('number_unit');
        //$students = Student::find(1)->lessons()->sum('number_unit');
        // $students = Student::with(['lessons' => function ($query) {
        //     //$query->withCount('lessons')sum('number_unit');
        //     //$query;
        // }])->withSum('lessons as total_unit', 'number_unit')->get();
        // $students = Student::with(['lessons' => function ($query) {
        //     //$query->wherHas(['lesson_name', 'lesson_code', 'number_unit']);
        // }])->wherePivot('id', 'student_id')->get()->toArray();
        if($students)
            return response()->json([
                'state' => true,
                'message' => 'success',
                'data' => $students,
            ], 200);

        //$students = Student::with('lessons')->get();
        // $students = Student::all();
        // $studentId = Student::all()->pluck('id');
        // dd($students);
        // $roles = Student::find(1)->lessons()->select(['number'])->get()->toArray();
        // dd($roles);
        // foreach($students as $student)
        // {
        //     $studenter = [];
        //     $studenter = $student->lessons()->select(['number'])->get();
        // }
        //  dd($studenter);
        //$student->lessons->
        //dd($studentId);

        // $total = Student::wherePivot('lesson_id', function ($query) {
        //     //$query->wherePivot('')->get();
        // })->get()->toArray();

        //dd($total);
        //return view('welcome', compact('students'));
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
        $studentId = $request->input('studentId');
        $lessonId = $request->input('lessonId');
        $number = $request->input('number');

        $student = Student::findOrFail($request->input('studentId'));
        //dd($student->lessons()->attach($lessonId));
        $student->lessons()->sync($lessonId, ['number' => $number]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        dd($student->lessons);

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
        $lessonId = $request->input('lessonId');
        $number = $request->input('number');
        //dd($student->lessons()->attach($lessonId));
        $student->lessons()->attach($lessonId, ['number' => $number]);
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
