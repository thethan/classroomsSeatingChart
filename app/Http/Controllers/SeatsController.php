<?php

namespace App\Http\Controllers;

use App\Jobs\SeatFormFields;
use App\Seat;
use App\Table;
use App\Jobs\TableFormFields;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\SeatsRequest;

class SeatsController extends Controller
{
    protected $fields =
        [
            'number' => '',
            'table_id' => '',
        ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tableId)
    {

        $data = $this->dispatch(new TableFormFields($tableId));
        return view('admin.seats.index', $data)
            ->with('table_id', $tableId);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->dispatch(new SeatFormFields());


        return view('admin.seats.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeatsRequest $request)
    {
        $seat = new Seat();
        foreach(array_keys($this->fields) as $field)
        {
            $seat->$field = $request->get($field);
        }
        $seat->save();

        return redirect('/admin/tables/'.$seat->table_id.'/seats')
            ->withSuccess("The seat '$seat->number'  was created");

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
        $data = $this->dispatch(new SeatFormFields($id));

        return view('admin.seats.edit', $data);


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
        $seat = Seat::findOrNew($id);
        foreach(array_keys($this->fields) as $field)
        {
            $seat->$field = $request->get($field);
        }
        $seat->save();

        return redirect('/admin/tables' .$seat->table_id .'/seats')
            ->withSuccess("The table '$seat->number'  was edited");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tableid, $seatId)
    {
        $seat = Seat::findOrFail($seatId);
        $seat->delete();

        return redirect('/admin/tables/'.$seat->table_id.'/seats')
            ->withSuccess("The table '$seat->number' has been deleted.");
    }


}
