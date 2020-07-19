<?php

namespace App\Http\Controllers;
use  App\Mail\CancelRequest;

use Illuminate\Http\Request;
use App\Task;
use DB;
use Mail;

class TasksController extends Controller
{
    
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {   #this is to determion ne if the user is admin,,,, if the user is an admin the user will view all the records else, only the re;levant to the user
            $userlocation =auth()->user()->location;
            $alltasks = Task::all();
            $usertasks=array();
            if ($userlocation=='Admin') {
                $tasks= Task::all();
            } else {
                foreach ($alltasks as $task) {
                    $town=$task->location;
                    $town=explode(",",$town);
                    $town=$town[0];
                    if ($town==$userlocation) {
                        array_push($usertasks, $task);
                    } else {
                        $tasks='not availale';
                    }
                    
            }
            $tasks=$usertasks   ;   
            
                
            }
            

           
            return view('tasks.index')->with('tasks',$tasks);
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('tasks.create');
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
                'phone'=>'required|max:12|min:10',
                'town'=>'required'

                
            ]);
            // To check if the Car is at a slot
            $locate = DB::table('spaces')
                        ->where('st_id','=',$request->input('town'))
                        ->get();
           
            if($locate->isNotEmpty()){
                $town = $locate[0]->location;
                $street= $locate[0] ->street;
                $slot = str_split($locate[0]->st_id,4);
                $slot = $slot[1];
                $actuallocation= $town.' '.','.' '.$street.' '.'street,'.' '.'slot number'.' '.$slot;
            }else {
                $actuallocation= $request->input('town').','.$request->input('description');
            }
            $plate =$request->input('preffix').$request->input('numeric').$request->input('suffix');
            //to chek if the client details had already been recorded if not Record it,
                
            $client = \App\clients::updateOrCreate(
                    ['no_plate' => $plate],
                    [ 'name' => $request->input('name'),'phone' => $request->input('phone'),'email'=>$request->input('email')]
                );
            
   
            //This is the one generated when a guest log in... must find a user generated.... when c;<amped class=""></amped>
            $task= new Task;
            $task->no_plate =  $plate;
            $task->name= $request->input('name');
            $task->location = $actuallocation;
            $task->destination = $request->input('destination');
            $task->phone= $request->input('phone');
            $task->status=0;
            $task->type=0;
            if ($request->input('email')->isset()) {
                $task->email=$request->input('email');
            }
            
            $task->token=$request->session()->get('_token');
            $task->save();
            //Uncomment this and the app wiill send mail to the users email if set...
            //Mail::to($task->email)->send(new CancelRequest($task));
            return redirect('tasks')->withStatus('success','Your Request has been successfully submitted');
    
    
        }
    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $task = Task::find($id);
            return view('tasks.show')->with('task');
        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $task = Task::find($id);
            return view('tasks.edit')->with('task', $task);
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
                'name'=>'required|string',
                'phone'=>'required|max:12|min:10',
                'location'=>'required|string'
                
            ]);
            
            $task= Task::find($id);
            $task->name= $request->input('name');
            $task->location= $request->input('location');
            $task->email=$request->input('email');
            $task->destination=$request->input('destination');
            $task->phone= $request->input('phone');
            $task->save();
            return redirect('tasks')->withStatus(__('Task successfully updated.'));
            
        }

        
        // This is to change the status of the task to be done. 
        public function do($id)
        {
            $task =Task::find($id);
            $task->status = 1;
            $task->save();
            return redirect('tasks');
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $task = Task::find($id);
            $task->delete();
            return redirect('tasks')->with('success', 'Task Deleted');
        }
    
    
}
