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
            'preffix'=>'required|max:3|alpha',
            'numeric'=>'required|integer',
            'suffix'=>'alpha|max:1',
            'name'=>'required',
            'space_id'=>'required'
        ]);



        $record = new Record;
        $preffix= $request->input('preffix'); 
        $numeric=$request->input('numeric');
        $suffix=$request->input('suffix');   
        $record->no_plate=$preffix.$numeric.$suffix;
        $record->name=$request->input('name');
        $i = str_split($request->input('space_id'));
        $j=0;
        while ($j <= 3) {
            array_shift($i);
            $j++;
        }
        $i=implode($i);
        $record->space_id=$i;
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
