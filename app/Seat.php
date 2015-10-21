<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $table = 'seats';

    public function table()
    {
        return $this->belongsTo('App/Table');
    }

    public function seatingChart()
    {
        return $this->hasMany(Seat::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

}
