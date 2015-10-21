<?php

namespace App;



use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SeatingChart extends Model
{

    protected $table = 'seatingcharts';

    public $chart = array();

    public $studentRoster = array();

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
            $seats = $table->seats;
            foreach($seats as $seat){
                $this->chart[$table->color][$seat->id] = null;
                if(array_key_exists($seat->id, $this->studentRoster)){
                    $this->chart[$table->color][$seat->id] = $this->studentRoster[$seat->id];
                }
            }
        });

    }

    protected function roster(Collection $students)
    {
        $return = array();
        foreach($students as $student){

            $this->studentRoster[$student->id] = null;

            if(!empty($student->seat->id)) {
                $this->studentRoster[(string) $student->id] = (string) $student->seat->id;
            }
        }
    }

}
