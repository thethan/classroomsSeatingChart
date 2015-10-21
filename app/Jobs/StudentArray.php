<?php

namespace App\Jobs;

use App\Classroom;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use PhpParser\Node\Stmt\ClassTest;

class StudentArray extends Job implements SelfHandling
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id = null)
    {



        $this->classroom_id = $id;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $classroom =  Classroom::find($this->classroom_id);

        $students = $classroom->students;

        $return = array();

        foreach($students as $student){
            $return[$student->id] = $student->name;
        }

        return $return;
    }
}
