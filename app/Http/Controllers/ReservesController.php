<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserve;
use DB;

class ReservesController extends Controller
{
     public function edit($id)
    {
        $reserve=Reserve::find($id);
        return view('reserves.edit')->with('reserve',$reserve);
    }
    public function destroy($id)
    {
        $reserve=Reserve::find($id);
        $space_id = $reserve->space_id;
        $space= \App\Space::find($space_id);
        $space->status=0;
        $space->save(); 
       $reserve->delete();
        return redirect('spaces')->with('message','space Written off');
    }
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'space_id'=>'required|string',
            'organisation'=>'required',
            'email'=>'required|email',
            'duration'=>'required|integer'
            
        ]);
        
        $reserve= Reserve::find($id);
        $space = DB::table('spaces')
                ->where('st_id','=',$request->input('space_id'))
                ->get();
        
        $reserve->space_id= $space[0]->id;
        $reserve->organisation= $request->input('organisation');
        $reserve->email=$request->input('email');
        $reserve->duration=$request->input('duration');
        $reserve->save();
        return redirect('spaces')->withStatus(__('Space successfully updated.'));
        
    }

}
