<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reequest;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests= Request::all();
        return view('request.index')->with('requests',$requests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('request.create');
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
        
        $req= new Request;
        $req->name= $request->input('name');
        $req->location= $request->input('location');
        $req->phone= $request->input('phone');
        $req->save();
        // will introduce auth that would redirect the different users to their deffault pages
        return redirect('requests')->with('success','Your request has been successfully submitted');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $req = Request::find($id);
        return view('requests.show')->with('req');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $req = Request::find($id);
        return view('requests.edit');
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
        
        $req= new Request;
        $req->name= $request->input('name');
        $req->location= $request->input('location');
        $req->phone= $request->input('phone');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
