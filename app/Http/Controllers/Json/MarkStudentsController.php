<?php

namespace App\Http\Controllers\Json;

use App\Student;
use App\Mark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class MarkStudentsController extends Controller
{

    /**
     * @param $id student Id
     * @param $markId
     */
    public function addMark($id, $markId)
    {
        $student = Student::find($id);

        $mark = Mark::find($markId);

        $student->mark()->save($mark);

        return response('',204);

    }

    /**
     * @param $id
     * @param $markId
     */
    public function removeMark($id, $markId)
    {
        $student = Student::find($id);

        $student->deleteMark($markId);

        return response(null,204);
    }
}
