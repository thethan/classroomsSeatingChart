<?php

namespace App\Http\Controllers;

use App\Classroom;
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
        $classroom = new Classroom();
        return view('admin.classrooms.create')
            ->with('grades', $classroom->grades);

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

        return redirect('/classrooms')
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
