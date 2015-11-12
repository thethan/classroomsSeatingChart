<?php

namespace App\Http\Controllers\Json;

use App\Classroom;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\SeatingChartCreator;
use App\Jobs\StudentArray;

class ClassroomController extends Controller
{
    protected $fields =
        [
          'teachername' => '',
            'grade' => '',
        ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $return = Classroom::all();

        return response()->json(['data' => $return]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $classroomId
     * @return \Illuminate\Http\JsonResponse
     */
    public function assign($classroomId)
    {
        $data = $this->dispatch(new SeatingChartCreator($classroomId));

        return response((array)$data);
    }

    /**
     * @param $classroomId
     * @return \Illuminate\Http\JsonResponse
     */
    public function students($classroomId)
    {
        $students = $this->dispatch(new StudentArray($classroomId));


        return response((array)$students, 200);
    }
}
