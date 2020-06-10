<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchesController extends Controller
{
    public function search(Request $request)
    {
        
     switch ($request->input('options')) {
        case 'records':
             $result= \App\Record::where('no_plate','=',$request->input('searchinput'))->orWhere('name','=',$request->input('searchinput'))->get();
             $origin = 'records';
             break;
        case 'requests':
            $result= \App\Task::where('no_plate','=',$request->input('searchinput'))->orWhere('name','=',$request->input('searchinput'))->get();
            $origin = 'requests';
            break;
        case 'clients':
            $result= \App\clients::where('no_plate','=',$request->input('searchinput'))->orWhere('name','=',$request->input('searchinput'))->get();
            $origin = 'clients';
            break;
        default:
         $result= \App\Record::where('no_plate','=',$request->input('searchinput'))->orWhere('name','=',$request->input('searchinput'))->get();
         $origin = 'clients';
        break;
     }
     $query =$request ;
     return view('search.results')->with('result',$result)->with('query',$query)->with('origin',$origin);
     
    }
}
