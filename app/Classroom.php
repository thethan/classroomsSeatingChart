<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public $grades = [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5=>'5', 6 => '6', 7 => '7' , 8 => '8' , 9 => '9', 10 => '10', 11 => '11', 12 => '12', 'K' => 'K', 'TK' =>'TK' ];

    //
    protected $table = 'classrooms';


    public function grades()
    {
        return $this->grades;
    }

    public function seatingChart()
    {
        return $this->hasOne('seating_chart');
    }

}
