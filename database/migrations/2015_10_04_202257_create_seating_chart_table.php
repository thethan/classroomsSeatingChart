<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatingChartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_seatingcharts', function(Blueprint $table){
            $table->increments('id');
            $table->integer('classroom_id');
            $table->integer('seatingchart_id');
        });

        Schema::create('seatingcharts', function(Blueprint $table){
            $table->increments('id');
            $table->integer('classroom_id');

            $table->foreign('classroom_id')
                ->references('id')->on('classrooms')
                ->onDelete('cascade');
        });

        Schema::create('seat_seatingcharts', function(Blueprint $table){
            $table->increments('id');
            $table->integer('seat_id');
            $table->integer('seatingchart_id');

            $table->foreign('seat_id')
                ->references('id')->on('seats')
                ->onDelete('cascade');

            $table->foreign('seatingchart_id')
                ->references('id')->on('seatingcharts')
                ->onDelete('cascade');

        });

        /*
         * Seat to student
         */
        Schema::create('seat_student', function(Blueprint $table){
            $table->increments('id');
            $table->integer('seat_id');
            $table->integer('student_id');

            $table->foreign('seat_id')
                ->references('id')->on('seats')
                ->onDelete('cascade');

            $table->foreign('student_id')
                ->references('id')->on('students')
                ->onDelete('cascade');

        });


        Schema::create('seating_charts_pivot', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('classroom_id');
            $table->integer('seat_id');
            $table->timestamps();

            $table->foreign('classroom_id')
                ->references('id')->on('classrooms')
                ->onDelete('cascade');

            $table->foreign('student_id')
                ->references('id')->on('students')
                ->onDelete('cascade');

            $table->foreign('seat_id')
                ->references('id')->on('seats')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('seatingcharts');
        Schema::drop('seat_seatingcharts');
        Schema::drop('seat_student');
        Schema::drop('seating_charts_pivot');
        Schema::drop('classroom_seatingcharts');
    }
}
