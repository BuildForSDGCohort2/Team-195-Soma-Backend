<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_lang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("course_id");
            $table->unsignedBigInteger("language_id");
            $table->foreign("course_id","fk_course_lang")->references("id")->on("course")
                                                            ->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("language_id","fk_lang_course")->references("id")->on("language")
                                                            ->onDelete("cascade")->onUpdate("cascade");
            $table->unique(["id","course_id","language_id"],"course_lang_course_id_lang_id_primary_key");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_lang');
    }
}
