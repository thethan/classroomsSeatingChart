<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Jobs\ClassroomFormFields;
use App\Jobs\SeatingChartCreator;
use App\Jobs\StudentArray;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ClassroomRequest;
use App\Http\Controllers\Controller;

class Classrooms extends Controller
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
        return view('admin.classrooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->dispatch(new ClassroomFormFields());


        return view('admin.classrooms.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassroomRequest $request)
    {
        $classroom = new Classroom();
        foreach(array_keys($this->fields) as $field)
        {
            $classroom->$field = $request->get($field);
        }
        $classroom->save();

        return redirect('/admin/classrooms')
            ->withSuccess("The tag '$classroom->teachername' '$classroom->grade' was created");

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
        $data = $this->dispatch(new ClassroomFormFields($id));

        return view('admin.classrooms.edit', $data);


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
        $classroom = Classroom::findOrNew($id);
        foreach(array_keys($this->fields) as $field)
        {
            $classroom->$field = $request->get($field);
        }
        $classroom->save();

        return redirect('/admin/classrooms')
            ->withSuccess("The tag '$classroom->teachername' '$classroom->grade' was created");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();

        return redirect('/admin/classrooms')
            ->withSuccess("The classroom '$classroom->teachername $classroom->grade' has been deleted.");
    }




    public function assignSeatingChart($classroomId)
    {
        $data = $this->dispatch(new SeatingChartCreator($classroomId));

        $classroom = Classroom::find($classroomId);

        $students = $this->dispatch(new StudentArray($classroomId));

        return view('admin.seatingchart.index')
            ->with('classroomId', $classroomId)
            ->with('chart', $data)
            ->with('students', $students);
    }
}
