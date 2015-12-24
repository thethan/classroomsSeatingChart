<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Mark;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\ClassroomFormFields;
use Maatwebsite\Excel\Facades\Excel;
use Psy\Formatter\Formatter;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.selectClassroom');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function selectRange($id)
    {
        $data = $this->dispatch(new ClassroomFormFields($id));
        return view('admin.reports.selectRange', $data);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function query(Request $request, $id)
    {
        $concat = $request->get('concat');


        $start = str_replace('"','',$request->get('start'));
        $end = str_replace('"','',$request->get('end'));

        $marks = Mark::all();

        $classroom = Classroom::find($id);
        $classroom->reports($start, $end, $concat);

        $report = $classroom->reportsToArray($marks);

        Excel::create($classroom->teachername . "_". $classroom->grade, function($excel) use($report, $marks) {

            $excel->sheet('', function($sheet) use($report, $marks){

                $sheet->loadView('admin.excel.tests.test',array('data' => $report, 'marks' => $marks));

            });

        })->download('csv');

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
}
