<?php

use App\Models\Lesson;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('lesson_name')->unique();
            $table->string('lesson_code')->unique();
            $table->integer('units');
            $table->timestamps();
        });

        $lesson_name = ['Math', 'Experimental', 'Quran', 'Sport', 'Farsi', 'Arabic', 'English', 'chemistry', 'Religious', 'social'];
        $lesson_code = [101, 102, 103, 104, 105, 106, 107, 108, 109, 110];
        $units = [11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

        for($i = 0; $i < 10; $i++)
        {
            $lesson = new Lesson();
            $lesson->lesson_name = $lesson_name[$i];
            $lesson->lesson_code = $lesson_code[$i];
            $lesson->units = $units[$i];
            $lesson->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
