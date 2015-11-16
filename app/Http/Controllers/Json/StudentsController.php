<?php

namespace App\Http\Controllers\Json;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use App\Http\Requests;
use App\Jobs\ClassroomFormFields;
use App\Http\Controllers\Controller;

class StudentsController extends Controller
{
    public $fields = [
        'name' => '',
        'classroom_id' => '',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($classroomId)
    {
       $return = Student::where('classroom_id', $classroomId)->get();

       return response()->json(['data' => $return]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($classroomId)
    {
        $data = ['name'=> null, 'classroomId' => $classroomId];
        return view('admin.students.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request, $classroomId)
    {
        $student = new Student();
        foreach(array_keys($this->fields) as $field)
        {
            $student->$field = $request->get($field);
        }
        $student->save();

        return redirect('/admin/classrooms/'.$classroomId.'/students')
            ->withSuccess("The tag '$student->name' was created");
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
    public function update(StudentRequest $request, $id)
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

    public function unassigned($classroomId)
    {
        $student = new Student();
        $students = $student->withoutSeat($classroomId);

        return response()->json($students);
    }

    /**
     *
     */
    public function marksToday($id)
    {
        $student = Student::find($id);

        $marks = $student->marksToday();

        $return = [];

        foreach($marks as $mark){
            $return  = (array)[$mark->marK_id  => $mark];
        }
        return response()->json((array)$return);
    }
}
