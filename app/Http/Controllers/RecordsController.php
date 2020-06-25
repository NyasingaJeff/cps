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
        
        $location = auth()->user()->location;
        
        //getting all the spaces under the user/ employee
        $spaces = \App\Space::where('location', '=' , $location)->get();
            //get all of the records on offenders
        $os=\App\Offender::all();
        //getting thre records  
        $allrecords =array();
        $alloffences =array();
        if ($location=='Admin') {
            $records = \App\Record::all();
            $offenders= \App\Offender::all();
        } else {
           
            foreach ($spaces as $space) {
                $rcd = $space->record;
                array_push($allrecords,$rcd);
            }
            $records=$allrecords[0];
            //get the offences under this users jurdisiction
            foreach ($os as $o) {
               
                $town=explode("-",$o->location);
                $town= $town[0];
                if ($town==$location." ") {
                    array_push($alloffences,$o);
                }
            }
            $offenders=$alloffences;
        }  
        


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
        //to validate the data  input by the user
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
       
        
        //to get the actual id from the  street alias input by the user
        $i = DB::table('spaces')
        ->where('st_id','=',$request->space_id)
        ->get();
        $space_id=$i[0]->id;
        
        //to Automatically add clients
        $client = \App\clients::updateOrCreate(
            ['no_plate' => $no_plate],
            [ 'name' => $request->input('name'),'phone' => $request->input('phone')]
        );       
        $record = new Record;
        $preffix= $request->input('preffix'); 
        $numeric=$request->input('numeric');
        $suffix=$request->input('suffix');   
        $record->no_plate=strtoupper($preffix.$numeric.$suffix);
        $record->phone=$request->input('phone');   
        $record->name=strtoupper($request->input('name'));
        $i = DB::table('spaces')
            ->where('st_id','=',$request->space_id)
            ->get();
        $record->space_id=$space_id;
        $record->save();

        // Now to check if the parked vehicle has some outstanding charges 
        // we first query the offenders table
        $pending = DB::table('offenders')
                    ->where('no_plate','=',$record->no_plate)
                    ->get();
        // isset() checks if the query above actually returned records
        if (isset($pending)) {
            $task = new \App\Task;
            $task->name = $record->name;
            $task->phone = $record->phone;
            // we use the space-record, one to many relationship
            $slot = ($request->input('space_id'));
            $slot=str_split($slot, 4);
            $task->location = $record->space->location.','.$record->space->street.'street , Slot:'.$slot[1];
            $task->destination = 'Impound!';
            //A type two task will alert the parking attendant
            $task->type = 1;
            $task->no_plate = $record->no_plate;
            $task->status = 0;
            $task->save();
        }
        
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
        $plate = str_split($record->no_plate, 3);
        $st_id= $record->space->st_id;   
        return view('records.edit')->with('record',$record)->with('plate', $plate)->with('st_id', $st_id);
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
          
        // $this->validate($request,[
        //     'no_plate'=>'required|max:7',
        //     'name'=>'required',
        //     'space_id'=>'required',
        // ]);



        $record = Record::find($id);
        
        $record->no_plate=$request->input('preffix').$request->input('numeric').$request->input('suffix');
        $record->name=$request->input('name');
        $a=DB::table('spaces')
                        ->where('st_id','=',$request->input('space_id'))
                        ->get();
         
        $record->space_id=$a[0]->id;;
        $record->save();
        return redirect('records')->withStatus(__('Record successfully updated.'));
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
        $crimes = \App\crime::all();
        return view('offenders.create')->with('record', $record)->with('crimes', $crimes);
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
        $offender->crime_id= $request->input('crime');
        //to check if the offender has any unpaid debts if so add it to the Fine the offender should pay.
        $debts= DB::table('offenders')
                        ->where('no_plate','=',$offender->no_plate)
                        ->where('status','=',0)
                        ->get();
        //checking if the client has more than 2 strikes,, if so multiply the outstanding charges with 2
        $strikes = count($debts);
       $crime=$request->input('crime');
        if (isset($crime)) {
            
            $fine = \App\Crime::find($request->input('crime'));
            $fine_due = $fine->fine;
        } 
        
    
        
           
        //if the offender has  more than three outsatanding crimes the system will automatically generate a record to indicate that.
        if ($strikes >= 3) {
            $outs= new \App\Offender;
            $outs->no_plate= $request->input('no_plate');
            $town= $request->town;
            $street=$request->street;
            $slot=$request->slot_no;
            $outs->location= $town.$street.$slot;
            $outs->make= $request->input('make');
            $outs->model= $request->input('model');
            $outs->color= $request->input('color');
            $outs->crime_id=3;
            $outs->fine_due= \App\Crime::find(3)->fine;
            $outs->status=0;
            $outs->save();
        }
        $offender->fine_due= $fine_due;
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
    