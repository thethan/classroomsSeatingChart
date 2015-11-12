<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Mark;
use Illuminate\Contracts\Bus\SelfHandling;

class MarksFormField extends Job implements SelfHandling
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $fields = $this->fieldList;

        if($this->id){
            $fields = $this->fieldsFromModel($this->id, $fields);
        }

        foreach ($fields as $fieldName => $fieldValue){
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }

        $fields['id'] = $this->id;
        $classroom = new Classroom();
        $fields['grades'] = $classroom->grades();

        return $fields;
    }

    /**
     * Return the field values from the model
     * @param $id
     * @param array $fields
     */
    protected function fieldsFromModel($id, array $fields)
    {
        $mark = Mark::findOrFail($id);

        $fieldNames = array_keys($fields);

        $fields = [$id => $id];

        foreach ($fieldNames as $field){
            $fields[$field] = $classroom->{$field};
        }

        return $fields;
    }
}
