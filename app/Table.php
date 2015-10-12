<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    //
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }


}
