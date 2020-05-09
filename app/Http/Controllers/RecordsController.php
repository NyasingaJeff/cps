<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;
use App\Offender;

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
        
        $offenders= \App\Offender::all();
        // $clamps = DB::table('offenders')
        //         ->where('status','=',0)
        //         ->get();
        // $impounds = DB::table('offenders')
        //         ->where('status','=',1)
        //         ->get();
        return view('records.index')->with('records',$records)->with('offenders', $offenders);
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
            'phone'=>'required|max:12|min:10'
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
        $i = DB::table('spaces')
            ->where('st_id','=',$request->space_id)
            ->get();
        $record->space_id=$space_id;
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

    // public function clamp(Request $request, $id)
    // {
    //     //add sms module, when clamped the owner gets alert... 
    //     //on phone. kama hakuna namba kwa client list clamp kavu...//
    //      //na iappend akikuja kulipa
    //     $record = Record::find($id);
    //     $record->status= 1 ;
    //     $record->save();
    //     return redirect('records')->with('message','Record edited');
    // }
        // this is to clamp a client that has parked unlawfully
    public function clamp ($id)
    {   
        
        $record= Record::find($id);
        return view('offenders.create')->with('record', $record);
    }

    //now to record the offender
    public function offender( Request $request){           
        
        $records= Record::all();
        $offender = new \App\Offender;;
        $offender->no_plate= $request->input('no_plate');
        $town= $request->town;
        $street=$request->street;
        $slot=$request->slot_no;
        $offender->location= $town.$street.$slot;
        $offender->make= $request->input('make');
        $offender->model= $request->input('model');
        $offender->color= $request->input('color');
        $offender->offence= $request->input('offence');
        $offender->status=0;
        $offender->save();
        return redirect('records')->with('message','record edited')->with('records',$records);

    }
    public function impound ($id)
    {   
        
        $offender= \App\Offender::find($id);
        $offender->status =1;
        $offender->save();
        return redirect('records');
    }
   
    // The funnction is for imoounding cars
   
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
