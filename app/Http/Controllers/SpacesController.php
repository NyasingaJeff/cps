<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Space;
class SpacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       
        $spaces=Space::all()->groupBy('location');
        return view('spaces.index')->with('spaces',$spaces);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('spaces.create');
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
            'location'=>'required|string',
            'street'=>'required|string',
            'price'=>'required|integer',
            'category'=>'required|string'
            
        ]);


        $x= Space::all();
        $x= count($x);
        $space = new Space;
        $space->location=$request->input('location');
        $space->price=$request->input('price');
        $space->category=$request->input('category');
        $space->street=$request->input('street');
        //to automatically generate a unique identifier
        $a= str_split($space->location,2);
        $a= $a[0];
        $b= str_split($space->street,2);
        $b = $b[0];
        $c=$x+1;
        $space->st_id = $a.$b.$c; 
        $space->save();
        return redirect('spaces')->with('message','Space Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //will add the fact the fxnality to view all the records tagged to this specific space
        $space= Space::find($id);
        return view('spaces.show')->with('space',$space);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $space= Space::find($id);
        return view('spaces.edit')->with('space', $space);
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
            'location'=>'required|string',
            'price'=>'required|integer',
            'category'=>'required|string'
            
        ]);



        $space = Space::find($id);
        $space->location=$request->input('location');
        $space->price=$request->input('price');
        $space->category=$request->input('category');
        $space->save();
        return redirect('spaces')->with('message','Infomation Edited Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $space=Space::find($id);
        $space->delete();
        return redirect('spaces')->with('message','space Written off');
    }
}
