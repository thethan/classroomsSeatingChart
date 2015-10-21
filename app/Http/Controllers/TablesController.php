<?php

namespace App\Http\Controllers;

use App\Table;
use App\Jobs\TableFormFields;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\TablesRequest;

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
        return view('admin.tables.index');
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
        $table = new Table();
        foreach(array_keys($this->fields) as $field)
        {
            $table->$field = $request->get($field);
        }
        $table->save();

        return redirect('/admin/tables')
            ->withSuccess("The tag '$table->color'  was created");

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
        $data = $this->dispatch(new TableFormFields($id));

        return view('admin.tables.edit', $data);


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
        $table = Table::findOrNew($id);
        foreach(array_keys($this->fields) as $field)
        {
            $table->$field = $request->get($field);
        }
        $table->save();

        return redirect('/admin/tables')
            ->withSuccess("The table '$table->color'  was created");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        $table->delete();

        return redirect('/admin/tables')
            ->withSuccess("The table '$table->color' has been deleted.");
    }


    public function seats($tableId)
    {

        $data = $this->dispatch(new TableFormFields($tableId));
        $table = Table::find($tableId);

        return view('admin.seats.index', $data)
            ->with('table_id' , $tableId);

    }
}
