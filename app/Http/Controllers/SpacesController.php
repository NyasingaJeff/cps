<?php

namespace App\Http\Controllers;

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
        $reserved= 0 ;
        $nonreserved = 0 ;
        $spaces=Space::all()->groupBy('location');
        foreach ($spaces as $location => $value) {
            foreach ($value as $val) {
                if ($val->status==0) {
                    $reserved = $reserved + 1;
                } elseif ($val->status==1) {
                    $nonreserved == $nonreserved +  1;
                }
                
            }
        }
        return view('spaces.index')->with('spaces',$spaces)->with('reserved', $reserved)->with('nonreserved',$nonreserved);

        
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
            'price'=>'required|integer',
            'category'=>'required|string'
            
        ]);



        $space = new Space;
        $space->location=$request->input('location');
        $space->price=$request->input('price');
        $space->category=$request->input('category');
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
