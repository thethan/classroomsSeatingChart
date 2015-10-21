<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
