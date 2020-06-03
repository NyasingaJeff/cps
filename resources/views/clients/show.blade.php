@extends('layouts.app', ['activePage' => 'client-management', 'titlePage' => __('Client-Records Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div>
                <span class="text-primary">PLATE:</span><span>{{$client->no_plate}}</span></br><span class="text-primary">OWNER:</span><span>{{$client->name}}</span>,<span>{{$client->phone}}.{{$client->email}}</span>

               
            </div>
            <div class="col-12 text-right">
                    <a href="{{ route('client.pdf',$client) }}" class="btn btn-sm btn-primary">{{ __('Download Report') }}</a>
                  </div>
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Parking Records') }}</h4>
                <p class="card-category"> {{ __('Here you can view records') }}</p>
                </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
               
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary " >                     
                     <th>
                        {{ __('Town') }}
                      </th>                     
                     <th>
                        {{ __('Street') }}
                      </th>
                      <th>
                        {{ __('Spot Number') }}
                      </th>
                      <th>
                        {{ __('Parked at') }}
                      </th>
                      <th >
                        {{ __('Paid') }}
                      </th>                 
                    </thead>
                    <tbody>
                    
                      @foreach($client->record as $record)
                       @php
                          $a= $record->space->st_id;
                          $a= str_split($a , '4');
                                               
                       @endphp                     
                                            
                        <tr>
                          <td>
                            {{ $record->space->location }}
                          </td>
                          <td>
                            {{ $record->space->street }}
                          </td>
                          <td>
                            {{ $a[1]}}
                          </td>
                          <td>
                            {{ $record->created_at->format('Y-m-d H:i:s') }}
                          </td> 
                          <td >
                            {{ $record->space->price}}
                           
                            
                          </td>            
                        </tr>
                       
                    
                      @endforeach
                      <tr>
                        <td ></td>
                        <td></td>
                        <td></td>
                        <td class="text-success text-center">Total:</td>
                        <td class="text-primary">{{$totalparkingfees}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-12">
        <div class="col-12 text-right">
                    <a href="{{ route('chargesheet.pdf',$client) }}" class="btn btn-sm btn-danger">{{ __('Download Chargsheet') }}</a>
                  </div>
            <div class="card">
              <div class="card-header card-header-danger">
                <h4 class="card-title ">{{ __('Offence Records') }}</h4>
              </div>
              <div class="card-body">
              <div class="col-12 text-right">
                <span class="text-info">Unpaid Fines:</span><span class="text-primary">KSH :{{$totalFines}}</span>
              </div>
              <div class="row text-right"></div>             
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-danger">
                     
                      <th>
                        {{ __('location') }}
                      </th>
                      <th>
                        {{ __('CLamped') }}
                      </th>
                      <th>
                        {{ __('Crime') }}
                      </th>                     
                     <th class="text-right">
                        {{ __('Fine') }}
                      </th>
                      
                      <th class="text-right">
                        {{ __('Status') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($offences as $offence)
                      
                      
                                            
                        <tr>
                         
                          <td>
                            {{ $offence->location }}
                          </td>
                          <td>
                            {{ $offence->created_at }}
                          </td>
                          <td >
                            {{ $offence->crime->name}}
                          </td>
                          <td class="text-right">
                            {{ $offence->crime->fine}}
                          </td>
                          <td class="text-right">
                           @php
                           if($offence->trashed){
                               $status='Paid';
                           }else{
                               $status='Un-paid';
                           }
                           @endphp
                           {{$status}}
                          </td>
                                               
                        </tr>
                      
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection