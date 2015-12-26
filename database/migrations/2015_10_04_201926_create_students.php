<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();

        });
        //
        Schema::create('students', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('classroom_id');
            $table->integer('seat_id')->nullable();
            $table->timestamps();

            $table->foreign('classroom_id')
                ->references('id')->on('classrooms')
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
        Schema::drop('students');

        Schema::drop('markes');
    }
}
