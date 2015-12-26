<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarkStudentPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mark_student', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('marK_id');
            $table->integer('student_id');
            $table->timestamps();

//            $table->foreign('mark_id')
//                ->references('id')->on('marks')
//                ->onDelete('cascade');
//
//            $table->foreign('student_id')
//                ->references('id')->on('students')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mark_student');
    }
}
