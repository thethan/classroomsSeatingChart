<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    public function seat()
    {
        return $this->belongsTo('App\Seat');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public function students()
    {
        return $this->belongsToMany('App\Mark');
    }


    public function withoutSeat($classroomId)
    {
        return DB::table('students')
            ->where('classroom_id', $classroomId)
            ->whereNull('seat_id')
            ->get();
    }
}
