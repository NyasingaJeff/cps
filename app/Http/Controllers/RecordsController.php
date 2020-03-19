<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;
class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records= Record::all();
        $n=now();    
        return view('records.index')->with('records',$records)->with('n',$n);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('records.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'alpha'=>'required|max:3|alpha',
            'numeric'=>'required|integer',
            'alpha2'=>'alpha|max:1',
            'name'=>'required',
            'space_id'=>'required'
        ]);



        $record = new Record;
        $a= $request->input('alpha'); 
        $a= str_split($a,1);
        $a=collect($a);
        $b=$request->input('numeric');
        $b=collect($b);
        $c=$request->input('alpha2');
        $c=collect($c);
        $plate=$a->concat($b)->concat($c);       
        $record->no_plate=$plate;
        $record->name=$request->input('name');
        $record->space_id=$request->input('space_id');
        $record->save();
        return redirect('records')->with('message','Space Booked Succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record= Record::find($id);
        return view('records.show')->with('record', $record);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record= Record::find($id);
        return view('records.edit')->with('record',$record);
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
        $this->validate($request,[
            'no_plate'=>'required|max:7',
            'name'=>'required',
            'space_id'=>'required',
        ]);



        $record = Record::find($id);
        $record->no_plate=$request->input('no_plate');
        $record->name=$request->input('name');
        $record->space_id=$request->input('space_id');
        $record->save();
        return redirect('records')->with('message','record edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record= Record::find($id);
        
        $record->delete();
       
        return redirect('\records')->with('success','record deleted');
    }
}
