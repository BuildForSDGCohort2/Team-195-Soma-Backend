<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_cat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("course_id");
            $table->unsignedBigInteger("category_id");
            $table->foreign("course_id","fk_course_category")->references("id")->on("course")
                                                            ->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("category_id","fk_category_course")->references("id")->on("category")
                                                            ->onDelete("cascade")->onUpdate("cascade");
            $table->unique(["id","course_id","category_id"],"course_cat_course_id_category_id_primary_key");
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
        Schema::dropIfExists('course_cat');
    }
}
