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
        $lesson_name = ['Math', 'Experimental', 'Quran', 'Sport', 'Farsi', 'Arabic', 'English', 'chemistry', 'Religious', 'social'];
        $lesson_code = [101, 102, 103, 104, 105, 106, 107, 108, 109, 110];
        $units = [11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('lesson_name')->unique();
            $table->string('lesson_code')->unique();
            $table->integer('number_unit');
            $table->timestamps();
        });

        // $lesson = new Lesson();
        // foreach()
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
