<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Seat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('seats', function(Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->integer('table_id');
            $table->timestamps();

//            $table->foreign('table_id')
//                ->references('id')->on('tables')
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
        //
        Schema::drop('seats');
    }
}
