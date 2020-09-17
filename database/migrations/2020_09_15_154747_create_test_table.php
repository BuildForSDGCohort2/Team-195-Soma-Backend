<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->unsignedBigInteger("lesson_id");
            $table->unsignedBigInteger("question_id");
            $table->unsignedBigInteger("grade_id");
            $table->unsignedTinyInteger("status");
            $table->timestamps();
            $table->foreign("lesson_id","fk_lessons")->references("id")->on("lesson")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("question_id","fk_questions")->references("id")->on("question")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("grade_id","fk_grades")->references("id")->on("grade")->onDelete("cascade")->onUpdate("cascade");
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test');
    }
}
