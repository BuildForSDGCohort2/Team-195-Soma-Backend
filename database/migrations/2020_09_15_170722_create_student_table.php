<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("lesson_id");
            $table->unsignedBigInteger("test_id");
            $table->unsignedBigInteger("practice_level");
            $table->unsignedBigInteger("course_id");
            $table->timestamps();
            $table->foreign("user_id","fk_user")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("lesson_id","fk_student_lesson")->references("id")->on("lesson")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("test_id","fk_student_test")->references("id")->on("test")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("course_id","fk_student_course")->references("id")->on("course")->onDelete("cascade")->onUpdate("cascade");
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
}
