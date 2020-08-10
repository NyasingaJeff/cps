<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {   
        $user = auth()->user();
        $all_spaces = \App\Space::all();
        $all_tasks= \App\Task::all();
        if ($user->hasRole('admin')) {
            $spaces = $all_spaces; 
            $tasks = $all_tasks;
        } else {
            $spaces = $all_spaces->filter(function($value,$key){
                return $value->location == auth()->user()->location || explode(',',$value->location)[0] == auth()->user()->location;
            });
            $tasks = $all_tasks->filter(function($value,$key){
                return $value->location == auth()->user()->location || explode(',',$value->location)[0] == auth()->user()->location;
            });
            
            // $spaces = \App\Space::where('location','=',$user->location)->get();
            // $tasks = \App\Task::where('location','=',$user->location)->get();
        }
        
        
        $revenue_each = []; #this is an asociative array used to hold the Space's id and its total revenue
        foreach ($spaces as $space) {
            $records = $space->record;          
            $revenue = count($records)*$space->price;#get the number of records          
            $revenue_each[$space->id]=$revenue;#append it to our assoc array
        }
        #should sort and still make sure the keys do not change
        $sorted = $revenue_each;
        rsort($sorted); #sort in reverse order
        $earners = array_slice($sorted,0,5);#this will be used to get the id   
    
        foreach ($earners as $revenue) {
            $id = array_keys($revenue_each,$revenue);
            $top_earners[array_pop($id)]=$revenue;
        }
       
        // return 

        // $employees = \App\User::all();
        $pending_tasks=[];
        $done_tasks= [];
        $criminals = [];
        foreach ($tasks as $task) {
            if ($task->type == 1 && $task->status == 1) {
                array_push($criminals,$task);            
            }elseif ($task->status == 0) {
                array_push($pending_tasks,$task);
            }elseif ($task->status == 1) {
                array_push($done_tasks,$task);
            }{

            }
        }
        return view('dashboard')->with('spaces',$spaces)->with('criminals',$criminals)->with('top_earners',$top_earners)
        ->with('pending_tasks',$pending_tasks)->with('done_tasks',$done_tasks)->with('all_spaces',$all_spaces);
    }
}

