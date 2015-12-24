<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Cloner\VarCloner;

class Classroom extends Model
{
    public $grades = [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5=>'5', 6 => '6', 7 => '7' , 8 => '8' , 9 => '9', 10 => '10', 11 => '11', 12 => '12', 'K' => 'K', 'TK' =>'TK' ];

    //
    protected $table = 'classrooms';

    public $roster;

    public $report;


    public function grades()
    {
        return $this->grades;
    }

    public function seatingChart()
    {
        return $this->hasOne('App\SeatingChart');
    }

    public function students()
    {
        return $this->hasMany('App\Student');
    }

    public function studentSeats()
    {
        $return = array();
        $students = $this->students();

        foreach($students as $student)
        {

            $return[$student->id] = $student->seat;
        }

        $this->roster = $return;
    }

    public function reports($start, $end, $concat = null)
    {
        $students = $this->students;
        $return = array();
        foreach($students as $student){
            $studentArray =[];
            $studentArray['id'] = $student->id;
            $studentArray['name'] = $student->name;
            $studentArray['marks'] = $student->marks($start, $end, $concat);
            $return[] = $studentArray;
        }
        $this->report = $return;

        return $return;

    }

    public function reportsToArray($marks)
    {
        $return = [];
        foreach($this->report as $report){
            $student['id'] = $report['id'];
            $student['name'] = $report['name'];

            foreach($marks  as $mark ) {
                $find = false;
                foreach($report['marks'] as $reportMark){
                    if($mark->id == $reportMark->marK_id){
                        $find = true;
                        $student[$mark->id] = $reportMark->mark_count;
                    }


                }
                if($find === false){
                    $student[$mark->id] = 0;
                }

            }

            $return[] = $student;

        }

        return $return;
    }



}
