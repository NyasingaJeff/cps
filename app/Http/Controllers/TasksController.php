<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

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
            return view('task.create');
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
            
            $task= new Task;
            $task->name= $request->input('name');
            $task->location= $request->input('location');
            $task->phone= $request->input('phone');
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
