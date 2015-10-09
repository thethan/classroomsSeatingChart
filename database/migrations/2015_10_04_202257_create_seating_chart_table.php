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
        Schema::create('seating_charts', function(Blueprint $table) {
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
        Schema::drop('seating_charts');
    }
}
