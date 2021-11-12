<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $s = Student::all();
        // dd($s);
        // $lessonId = Lesson::all()->pluck('id');
        // //dd($s);
        // $lessons = Lesson::with(['students' => function ($query) use ($lessonId) {
        //     //$query->select('id', 'lesson_code', 'lesson_name', 'number_unit', 'lesson_id', 'student_id', 'number');
        //     dd($query->whereIn('lesson_id', $lessonId)->get()->toArray());
        //     //$query->sum(DB::raw('number_unit * number'));
        // }])->get();
        //->withSum('lessons as sum_unit', 'number_unit')->get();
        //$studentId = Student::all()->pluck('id')->toArray();
        $students = Student::with(['lessons' => function ($query) {
            $query->select('id', 'lesson_code', 'lesson_name', 'number_unit', 'lesson_id', 'student_id', 'number')
              ;//->whereIn('student_id', $studentId)
            //->selectRaw('sum(number) as l');
              //->sum('number');
            //->select('number', 'number_unit');
        }])
        ->withSum('lessons as total_units', 'number_unit')
        ->get();
        // $studentId = Student::all()->pluck('id')->toArray();
        // //dd($s);
        //dd($students);
        foreach($students as $index => $student)
        {
            //dd($students[$index]->lessons);
            foreach($students[$index]->lessons as $i => $s){
                if($students[$index]->id == $students[$index]->lessons[$i]->student_id)
                    $students[$index]->total_number_units += $students[$index]->lessons[$i]->number_unit * $students[$index]->lessons[$i]->number;
            }
        }
        // $students = Student::with(['lessons' => function ($query) use ($studentId) {
        //     //$query->select('id', 'lesson_code', 'lesson_name', 'number_unit', 'lesson_id', 'student_id', 'number');
        //     //dd($query->wherePivot());
        //     // $query->whereIn('student_id', $studentId, function ($query) {
        //     //     dd($query->select('*'));
        //     // });
        //     //$query->sum(DB::raw('number_unit * number'));
        // }])
        // ->whereIn('id', )
        // ->withSum('lessons as sum_unit', 'number_unit')->get();

        // $studentId = Student::all()->pluck('id');
        // //dd($s);
        // $students = Student::with(['lessons' => function ($query) use ($studentId) {
        //     //$query->select('id', 'lesson_code', 'lesson_name', 'number_unit', 'lesson_id', 'student_id', 'number');
        //     //dd($query->wherePivot());
        //     $query->whereIn('student_id', $studentId, function ($query) {
        //         dd($query->select('*'));
        //     });
        //     //$query->sum(DB::raw('number_unit * number'));
        // }])
        // ->withSum('lessons as sum_unit', 'number_unit')->get();

        // dd($students);
        // foreach($students as $index => $l)
        // {
        //     dd($students);
        //     //dd($students->lessons[$index]->number_unit * $students->lessons[$index]->number_unit);
        // }
        // public function parts()
        // {
        //     return $this->belongsToMany('Part', 'project_part', 'project_id', 'part_id')
        //         ->selectRaw('parts.*, sum(project_part.count) as pivot_count')
        //         ->withTimestamps()
        //         ->groupBy('project_part.pivot_part_id')
        // }
        // $students = Student::with(['lessons' => function ($query) {
        //     $query->select('id', 'lesson_code', 'lesson_name', 'number_unit', 'lesson_id', 'student_id', 'number');
        // }])
        //     ->withSum('lessons as total_unit', 'number_unit')
        //     ->withSum('lessons as total_number', 'number_unit')->get();

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
    public function store(Request $request, Student $student)
    {
        //dd($student);
        $lessonId = Lesson::find($request->input('lessonId'));
        $number = $request->input('number');
        //dd($student->lessons()->attach($lessonId));
        if(!$student->lessons->contains($lessonId))
        //$productId->likes()->attach($userId, ['state' => $request->input('state')]);
            $student->lessons()->attach($lessonId, ['number' => $number]);
        //dd($student->id);
        foreach($student->lessons as $index => $s)
        {
            if(($student->lessons[$index]->pivot->lesson_id == $lessonId->id and $lessonId->students[$index]->pivot->student_id == $student->id))
                $student->lessons()->updateExistingPivot($lessonId, ['number' => $number], false);
            //dd($student->lessons[$index]->pivot->lesson_id == $lessonId->id);
            //dd($lessonId->students[$index]->pivot->student_id == $student->id);
            // if (($lessonId == $student->lessons[$index]->pivot->lesson_id) and ($lessonId->students[$index]->pivot->likes_id == $productId->id))
            //     $productId->likes()->updateExistingPivot($userId, ['state' => $request->input('state')], false);
        }

        return response()->json([
            'state' => true,
            'message' => 'success',
            'data' => null,
        ], 200);
        // $studentId = $request->input('studentId');
        // $lessonId = $request->input('lessonId');
        // $number = $request->input('number');

        // $student = Student::findOrFail($studentId);
        // //dd($student->lessons()->attach($lessonId));
        // $student->lessons()->sync($lessonId, ['number' => $number]);

        // return response()->json([
        //     'state' => true,
        //     'message' => 'success',
        //     'data' => null,
        // ], 200);
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
        $number = $request->input('number');
        //dd($student->lessons()->attach($lessonId));
        if(!$student->lessons->contains($lessonId))
        //$productId->likes()->attach($userId, ['state' => $request->input('state')]);
            $student->lessons()->attach($lessonId, ['number' => $number]);
        //dd($student->id);
        foreach($student->lessons as $index => $s)
        {
            if(($student->lessons[$index]->pivot->lesson_id == $lessonId->id and $lessonId->students[$index]->pivot->student_id == $student->id))
                $student->lessons()->updateExistingPivot($lessonId, ['number' => $number], false);
            //dd($student->lessons[$index]->pivot->lesson_id == $lessonId->id);
            //dd($lessonId->students[$index]->pivot->student_id == $student->id);
            // if (($lessonId == $student->lessons[$index]->pivot->lesson_id) and ($lessonId->students[$index]->pivot->likes_id == $productId->id))
            //     $productId->likes()->updateExistingPivot($userId, ['state' => $request->input('state')], false);
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
