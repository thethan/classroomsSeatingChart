<?php

namespace App\Http\Controllers\Json;

use App\Table;
use App\Jobs\TableFormFields;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\TablesRequest;
use App\Http\Controllers\Controller;

class TablesController extends Controller
{
    protected $fields =
        [
            'color' => '',
        ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $return = Table::all();

        return response()->json(['data' => $return]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->dispatch(new TableFormFields());


        return view('admin.tables.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TablesRequest $request)
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

        return view('admin.classrooms.create', $data);


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
}
