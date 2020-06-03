<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use DB;

class TasksController extends Controller
{
    
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {   
        
            $tasks= Task::all();
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
                'phone'=>'required',
                'location'=>'required'
                
            ]);
            // To check if the Car is at a slot
            $locate = DB::table('spaces')
                        ->where('st_id','=',$request->input('location'))
                        ->get();
           
            if($locate->isNotEmpty()){
                $town = $locate[0]->location;
                $street= $locate[0] ->street;
                $slot = str_split($locate[0]->st_id,4);
                $slot = $slot[1];
                $actuallocation= $town.' '.'town'.' '.$street.' '.'street,'.' '.'slot number'.' '.$slot;
            }else {
                $actuallocation= $request->input('location');
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
            $task->type=2;
            $task->token=$request->session()->get('_token');
            $task->save();
            // will introduce auth that would redirect the different users to their deffault pages
            return redirect('tasks')->with('success','Your Request has been successfully submitted');
    
    
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
            return view('tasks.edit');
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
                'name'=>'required|text',
                'phone'=>'required|max:10|integer',
                'location'=>'required|text'
                
            ]);
            
            $task= Task::find($id);
            $task->name= $request->input('name');
            $task->location= $request->input('location');
            $task->phone= $request->input('phone');
            $task->save();
            return redirect('tasks')->with('success', 'Task updated');
            
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
