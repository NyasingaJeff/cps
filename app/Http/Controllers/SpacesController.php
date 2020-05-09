<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Space;
use Illuminate\Support\Facades\DB;


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
        //to determine whether to load the reserved parking view
        $reserved = DB:: table('spaces')
                  ->where('status','=','1')
                  ->get();
        $reservedcount= count($reserved);
    
        return view('spaces.index')->with('spaces',$spaces)->with('reservedcount',$reservedcount);

        
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


        $space = new Space;
        $space->location=$request->input('location');
        $space->price=$request->input('price');
        $space->category=$request->input('category');
        $space->street=$request->input('street');
        
        
        //to automatically generate a unique identifier

        $streets = DB::table('spaces')
                ->where('location','=', $space->location)
                ->where('street','=',$space->street)
                ->get();
        $streetcount= count($streets);
        $x = $streetcount + 1 ;   
        $a= str_split($space->location,2);
        $a= $a[0];
        $b= str_split($space->street,2);
        $b = $b[0];
        if ($streetcount <= 9) {
            $space->st_id = $a.$b. '00'.$x; 
        } elseif ($streetcount <= 99) {
            $space->st_id = $a.$b.'0'.$x; 
        } else {
            $space->st_id = $a.$b.$x; 
        }
        
    
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
            'category'=>'required|string',
            'street'=>'required|string',
            
        ]);


        //first find the field to be edited
        $space = Space::find($id);
        $oldspace = Space::find($id);
        //to check if the user altered the prevous location information.. 
                 
        $space->location=$request->input('location');
        $space->street=$request->input('street');

        if( $space->location == $oldspace->location  &&  $space->street == $oldspace->street)
            {
                $space->st_id = $a.$b.$x; 
            } else {
                $streets = DB::table('spaces')
                ->where('location','=', $space->location)
                ->where('street','=',$space->street)
                ->get();
            $streetcount= count($streets);
            $x = $streetcount + 1 ;   
            $a= str_split($space->location,2);
            $a= $a[0];
            $b= str_split($space->street,2);
            $b = $b[0];
            if ($streetcount <= 9) {
             $space->st_id = $a.$b. '00'.$x; 
            } elseif ($streetcount <= 99) {
            $space->st_id = $a.$b.'0'.$x;
        }

         }
        $space->price=$request->input('price');
        $space->category=$request->input('category');

        $space->save();
        return redirect('spaces')->with('message','Infomation Edited Succesfully');
    }

    public function reserve ($id)
    {
        $space= Space::find($id);
        
        return view('reserves.create')->with('space', $space);
    }

    public function reservation (Request $request){

      
        //to actually store the reservation information
        DB::table('spaces')
            ->where('st_id','=',$request->space_id)
            ->update(['status' => 1]);
        $reserved= DB::table('spaces')
                    ->where('st_id','=',$request->space_id)
                    ->get();         
        
        
        $reservation = new \App\Reserve;
        $reservation ->space_id= $reserved[0]->id;
        $reservation ->email= $request->input('email');
        $reservation ->organisation=$request->input('organisation');
        $reservation ->duration= $request->input('duration');
        $reservation->save();
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
