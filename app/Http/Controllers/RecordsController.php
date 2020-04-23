<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;
use Illuminate\Support\Facades\DB;

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
        return view('records.index')->with('records',$records);
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
            'numeric'=>'required',
            'suffix'=>'alpha|max:1',
            'name'=>'required',
            'space_id'=>'required',
            'phone'=>'required'
        ]);

        $preffix= $request->input('preffix'); 
        $numeric=$request->input('numeric');
        $suffix=$request->input('suffix');   
        $no_plate=$preffix.$numeric.$suffix;

        $i = DB::table('spaces')
        ->where('st_id','=',$request->space_id)
        ->get();
        $space_id=$i[0]->id;
        
        //to Automatically add clients
        $client = \App\clients::updateOrCreate(
            ['no_plate' => $no_plate, 'name' => $request->input('name')],
            ['phone' => $request->input('phone')]
        );

            
        // $client = DB::table('clients')
        //         ->where('no_plate','=',$no_plate)
        //         ->get();
        // if(is_null($client)){
        //     $cl= new App\clients;
        //     $cl->name=$request->input('name');
        //     $cl->phone=$request->input('phone');
        //     $cl->no_plate=$no_plate;
        //     $cl->save();
        //     $record=$cl->record()->create([
        //         'no_plate'=>$request->input('no_plate'),
        //         'name'=>$request->input('name'),
        //         'phone'=>$request->input('phone'),
        //         'space_id'=>$space_id
               
        //     ]);
        // }else {
        //     $record= $client->record()->create([
        //         'no_plate'=>$request->input('no_plate'),
        //         'name'=>$request->input('name'),
        //         'phone'=>$request->input('phone'),
        //         'space_id'=>$space_id
        //     ]);
        // }
        

        $record = new Record;
        $preffix= $request->input('preffix'); 
        $numeric=$request->input('numeric');
        $suffix=$request->input('suffix');   
        $record->no_plate=$preffix.$numeric.$suffix;
        $record->phone=$request->input('phone');   
        $record->name=$request->input('name');
       // to automatically get the exact location where the vehicle is at
        $i = DB::table('spaces')
            ->where('st_id','=',$request->space_id)
            ->get();
        $record->space_id=$space_id;
        $record->save();
        
      return $record->client;
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

    public function clamp(Request $request, $id)
    {
        $record = Record::find($id);
        $record->status= 2 ;
        $record->save();
        return redirect('records')->with('message','Record edited');
    }
   
    // The funnction is for imoounding cars
    public function impound(Request $request)
    {
        $this->validate($request,[
            'preffix'=>'required|max:3|alpha',
            'numeric'=>'required',
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
        // $$record = $record->flatMap(function ($values) {
        //     return array_map('strtoupper', $values);
        // });
        $record->save();
        return redirect('records')->with('message','Space Booked Succesfully');
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
