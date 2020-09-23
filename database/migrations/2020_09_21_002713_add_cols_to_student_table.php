<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student', function (Blueprint $table) {
            //
            $table->unsignedTinyInteger("lesson_status")->default(0);
            $table->unsignedTinyInteger("test_status")->default(0);
            $table->unsignedTinyInteger("practice_status")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student', function (Blueprint $table) {
            //
            $table->dropColumn("lesson_status");
            $table->dropColumn("test_status");
            $table->dropColumn("practice_status");
        });
    }
}
