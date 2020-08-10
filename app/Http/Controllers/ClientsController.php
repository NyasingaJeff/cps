<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\clients;
use DB;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients= clients::all();
        return view('clients.index')->with('clients',$clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //clients are automatically added by the system.. :)
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //clients are automatically added by the system.. :)

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = clients::find($id);       
        $offences= \App\Offender::where('no_plate',$client->no_plate)->get();
        $records = $client->record;
        $parkingfees = array();
        foreach($records as $record){
        $price=$record->space->price;
        array_push($parkingfees,$price);
        }               
        $totalparkingfees = array_sum($parkingfees);
        $unpaidFines=array(); 
        foreach ($offences as $offence) {
            
            if ($offence->trashed) { 
                            
            }else {
                array_push($unpaidFines,$offence->fine_due);
            }             
        }
        
        $totalFines=array_sum($unpaidFines);
        return view('clients.show',compact(['totalparkingfees','totalFines']))->with('offences',$offences)
                                    ->with('client',$client)
                                    ->with('records',$records);
    }

    public function export_pdf($id){
        $client = clients::find($id);
        $records = $client->record;
        $totals=array();
        foreach ($records as $record) {
            array_push($totals,$record->space->price);
        }
        $totals= array_sum($totals);
         
        $pdf = \PDF::loadView('clients.report',compact(['client','records','totals']));
        return $pdf->download($client->no_plate.'-PARKINGREPORT'.'.pdf');
     }

     public function chargesheet_export_pdf($id){
        $client = clients::find($id);
        $offences= \App\Offender::where('no_plate',$client->no_plate)->get();
        $fines=array();
        foreach ($offences as $offence) {
            if ($offence->trashed) {
                
            } else {
                array_push($fines,$offence->fine_due);
            }           
           
        }
        $totalFines=array_sum($fines);
        $pdf = \PDF::loadView('clients.chargesheet',compact(['client','offences','totalFines']));
        return $pdf->download($client->no_plate.'-CHARGSHEET:'.date("d.m.Y.H.i.s").'.pdf');
     }
    public function pay($id) #this will not only drop all charges it wil delete the charges
    {
        #Get the client
        $client= clients::find($id);
        #Get the Records
        $fines=[];
        $offences= \App\Offender::where('no_plate',$client->no_plate);
        foreach ($offences as $offence) {
            if ($offence->trashed) {
                
            } else {
                array_push($fines,$offence->fine_due);
            }           
           
        }
        $totalFines=array_sum($fines);
        $offences->delete();
        #Recieve payment
        $pdf = \PDF::loadView('clients.chargesheet',compact(['client','offences','totalFines']));
        return $pdf->download($client->no_plate.'-CHARGSHEET:'.date("d.m.Y.H.i.s").'.pdf');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //clients are automatically edited by the system.. :)

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
         //clients are automatically edited by the system.. :)

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = clients::find($id);
        $client->delete();
    }
}
