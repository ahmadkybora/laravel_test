<?php

use App\Models\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('student_code')->unique();
            $table->string('national_code')->unique();
            $table->timestamps();
        });

        $first_name = ['Ali', 'Reza', 'Hossein', 'Arezo', 'Nahid', 'Morteza', 'Majid', 'Fateme', 'Hassan'];
        $last_name = ['Mohammadi', 'Azizi', 'Rezayi', 'Hosseiny', 'Alavi', 'Asghari', 'Habibi', 'Naseri', 'Moravej'];
        $student_code = [001121, 001222, 001323, 001424, 001525, 001626, 001727, 001345, 001346];
        $national_code = [91001121, 92001222, 93001323, 94001424, 95001525, 96001626, 97001727, 98001828, 99001929];
        
        for($i = 0; $i < 9; $i++)
        {
            $student = new Student();
            $student->first_name = $first_name[$i];
            $student->last_name = $last_name[$i];
            $student->student_code = $student_code[$i];
            $student->national_code = $national_code[$i];
            $student->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
