<?php

namespace App\Http\Controllers\Json;

use App\Seat;
use App\Table;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\AssignStudentRequest;
use App\Http\Controllers\Controller;

class SeatsController extends Controller
{
    protected $fields =
        [
            'number' => '',
        ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $seat = new Seat();
        $seats = $seat->all();
        foreach ($seats as $key => $value) {
            $value['table'] = $value->table;
            $return[$key] = $value;
        }

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($tableId)
    {
        $return = [];
        $tableName = $_GET['table'];
        $table = Table::find($tableId);
        $seats = $table->seats;

        foreach ($seats as $seat) {
            $seat->table_id = $tableName;
            $return[] = $seat;
        }


        return response()->json(['data' => $return]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Assign a student to a seat
     *
     * @param AssignStudentRequest $request
     * @param $seatId
     */
    public function assignStudent(AssignStudentRequest $request, $seatId)
    {
        $seat = Seat::find($seatId);

        $studentId = $request->only('student_id');
        $student = Student::find($studentId['student_id']);

        $seat->student()->save($student);


    }
}
