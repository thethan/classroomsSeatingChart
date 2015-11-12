<?php

namespace App;



use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SeatingChart extends Model
{

    protected $table = 'seatingcharts';

    public $chart = array();

    public $studentRoster = array();

    public $filledSeats = array();

    public $timestamps = false;


    public function classroom()
    {
        return $this->hasOne('App/Classroom');
    }

    public function tables()
    {
        return $this->hasMany('App/Table');
    }


    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function StudentInSeats()
    {
        $seats = $this->seats();

    }

    public function getChart(Collection $students = null)
    {

        $return = array();
        $this->roster($students);

        Table::all()->each(function($table){
            $this->chart[$table->id] = ['name' => $table->color, 'seats' => []];
            $seats = $table->seats;
            foreach($seats as $seat){

                $this->chart[$table->id]['seats'][$seat->id] = null;
                if(in_array($seat->id, $this->studentRoster)){

                    $this->chart[$table->id]['seats'][$seat->id] = $this->filledSeats[$seat->id];
                }
            }
        });

    }

    protected function roster(Collection $students)
    {
        foreach($students as $student){

            $this->studentRoster[$student->id] = null;

            if(!empty($student->seat->id)) {
                $this->studentRoster[$student->id] = $student->seat->id;
                $this->filledSeats[$student->seat->id] = $student->id;
            }
        }

    }

}
