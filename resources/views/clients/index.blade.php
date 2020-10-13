@extends('layouts.app', ['activePage' => 'clients-management', 'titlePage' => __('Client Management')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Clients') }}</h4>
                <p class="card-category"> {{ __('Here you can manage Clients') }}</p>
              </div>
            <div class="table-responsive">
            <table class="table">
             <thead class=" text-primary">
                <th>
                 {{__('Plate') }}
                </th>
                 <th>
                {{ __('Name') }}
                     </th>
                      <th>
                        {{ __('Phone') }}
                      </th>
                      <th>
                        {{ __('Email') }}
                      </th>                     
                      <th class="text-right">
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($clients as $client)                                 
                                            
                        <tr>
                          <td>
                            {{ $client->no_plate }}
                          </td>
                          <td>
                            {{ $client->name }}
                          </td>
                          <td>
                            {{ $client->phone }}
                          </td>
                          <td>
                            @php
                            if(isset($client->email)){
                                $email = $client->email;
                            }else{
                                $email = 'Not Provided'; 
                            }
                            @endphp
                            {{ $email}}
                          </td>
                          
                        <td class="td-actions text-right">

                            <div class="dropdown">
                              <a class="btn btn-sm btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 . . .
                               </a>
                             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">                                                                                          
                                                        
                                <form action="{{ route('clients.destroy', $client) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a class="dropdown-item" href="{{ route('clients.show', $client) }}">{{ __('View Records') }}</a>
                                  <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this record?") }}') ? this.parentElement.submit() : ''">
                                  {{ __('Delete') }}
                                  </button>
                                 </form>                                                                                                  
                             </div>
                          </div>                        
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

@endsection