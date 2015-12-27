<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Student extends Model
{
    /**
     * @var array
     */
    public $fillable = ['name','classroom_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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


    public function mark()
    {
        return $this->belongsToMany('App\Mark', 'mark_student')->withTimestamps();
    }

    public function selectMark($markId)
    {
        $tally = DB::table('mark_student')
            ->where('student_id',$this->id)
            ->where('mark_id', $markId)
            ->orderBy('created_at', 'desc')
            ->first();

        return $tally;
    }

    /**
     * @param $markId
     * @return bool
     */
    public function deleteMark($markId)
    {
        $tally = DB::table('mark_student')
            ->where('student_id',$this->id)
            ->where('mark_id', $markId)
            ->orderBy('created_at', 'desc')
            ->delete();

        return true;

    }

    /**
     * Get the marks based on Today
     */
    public function marksQuery()
    {
        $query =  DB::table('mark_student')
            ->where('student_id',$this->id)
            ->orderBy('created_at', 'desc');

        return $query;
    }

    /**
     *
     */
    public function marksToday($markId = null)
    {
        $query = $this->marksQuery();

        if($markId) {
            return $query
                ->select(DB::raw('count(mark_id) as mark_count'))
                ->whereBetween('created_at', [Carbon::today(), Carbon::tomorrow()])
                ->where('marK_id', $markId)
                ->groupBy('mark_id')
                ->first();
        } else {
            return $query->whereBetween('created_at', [Carbon::today(), Carbon::tomorrow()])
                ->groupBy('mark_id')
                ->select(DB::raw('*, count(mark_id) as mark_count'))
                ->get();
        }
    }

    /**
     * @param $start
     * @param $end
     * @param null $concat
     * @return mixed
     */
    public function marks($start, $end, $concat = null){
        $query = $this->marksQuery();

        return $query
            ->groupBy('mark_id')
            ->whereBetween('created_at', [$start, $end])
            ->select(DB::raw('count(mark_id) as mark_count, *'))
            ->get();
    }

    /**
     * Remove the last created on Mark
     */
    public function removeMark($mark)
    {

    }
}
