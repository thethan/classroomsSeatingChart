<?php

namespace App\Jobs;

use App\Seat;
use App\Table;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class SeatFormFields extends Job implements SelfHandling
{

    protected $id;

    protected $fieldList = [
        'number' => null,
        'table_id' => null,
    ];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id = null)
    {
        $this->id = $id;
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

        $tables = Table::all();
        $fields['tables'] = $tables;

        return $fields;
    }

    /**
     * Return the field values from the model
     * @param $id
     * @param array $fields
     */
    protected function fieldsFromModel($id, array $fields)
    {
        $classroom = Seat::findOrFail($id);

        $fieldNames = array_keys($fields);

        $fields = [$id => $id];

        foreach ($fieldNames as $field){
            $fields[$field] = $classroom->{$field};
        }

        return $fields;
    }
}

