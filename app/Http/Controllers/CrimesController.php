<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crime;

class CrimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crimes= Crime::all();
        return view('crimes.index')->with('crimes',$crimes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crimes.create');
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
            'name'=>'required',
            'fine'=>'integer|required',
            'description'=>'string|required'
        ]);


        $crime= new Crime;
        $crime->name=$request->input('name');
        $crime->fine=$request->input('fine');
        $crime->description=$request->input('description');
        $crime->save();
        return redirect('crimes')->with('succes','Criime Recorded');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crime= Crime::find($id);
        return view('crimes.show')->with('crime',$crime);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $crime= Crime::find($id);
        return view('crimes.edit')->with('crime',$crime);
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
            'name'=>'required',
            'fine'=>'integer|required'
        ]);


        $crime= Crime::find($id);
        $crime->name=$request->input('name');
        $crime->fine=$request->input('fine');
        $crime->save();
        return redirect('crimes')->with('success','Editted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crime= Crime::find($id);
        $crime->delete();
        return redirect('crimes')->with('info','Deleted');
    }
}
