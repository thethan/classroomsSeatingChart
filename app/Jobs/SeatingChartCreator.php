<?php

namespace App\Jobs;

use App\Classroom;
use App\Jobs\Job;
use App\Table;
use App\SeatingChart;
use Illuminate\Contracts\Bus\SelfHandling;

class SeatingChartCreator extends Job implements SelfHandling
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->classroom_id = (integer)$id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $return = $this->fillSeats();

        return $return;

    }


    protected function fillSeats()
    {
        $seatingchart = new SeatingChart();


        $classroom = Classroom::find($this->classroom_id);


        $classroom->studentSeats();


        $students = $classroom->students;


        $seatingchart->getChart($students);


        return $seatingchart->chart;
    }
}
