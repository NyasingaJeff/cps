@extends('layouts.app', ['activePage' => 'spaces', 'titlePage' => __('Space List')])

@section('content')
<div class="content">
    <div class="container-fluid">
                <div class="row">                   
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header card-header-primary">
                        <h4 class="card-title ">Non Reserved</h4>
                        <p class="card-category"> Non reserved Parking Spaces</p>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table">
                            <thead class=" text-primary">
                              <th>
                                Location
                              </th>
                              <th>
                                Street
                              </th>
                              <th>
                                Category
                              </th>
                              <th>
                                Bookings
                              </th>
                              <th>
                                Totals
                              </th>
                              <th class="text-right">
                                Actions
                              </th>
                            </thead>
                            <tbody>                            
                              @foreach ($spaces as $space)
                              
                              @if ($space->status !=1 )
                              <tr>
                                <td>
                                  {{$space->location}}
                                </td>
                                <td>
                                  {{$space->street}}
                                </td>
                                <td>
                                  {{$space->category}}
                                </td>
                                <td>
                                  {{$count= $space->record->count() }}
                                </td>
                                <td class="text-primary">
                                  {{$count*$space->price}}
                                </td>
                              <td class="td-actions text-right">

                                  <div class="dropdown">
                                  <a class="btn btn-sm btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      . . .
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                      <form method="post" action="{{ route('spaces.edit', $space) }}" autocomplete="off" class="form-horizontal">
                                        @csrf
                                        @method('put')
                                        <a class="dropdown-item" href="{{ route('space.reserve', $space) }}">{{ __('Reserve') }}</a>


                                      </form>
                                                                      
                                                        
                                <form action="{{ route('spaces.destroy', $space) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a class="dropdown-item" href="{{ route('spaces.edit', $space) }}">{{ __('Edit') }}</a>                               
                                  <a class="dropdown-item" href="{{ route('spaces.show', $space) }}">{{ __('View') }}</a>                               
                                  <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this space ?") }}') ? this.parentElement.submit() : ''">
                                  {{ __('Delete') }}
                                  </button>
                                 </form>                                                                                                  
                             </div>
                        </div>                        
                        </td> 
                              </tr>
                              @endif
                            
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  @if(isset($reserves))
                  <div class="col-md-12">
                    <div class="card card-plain">
                      <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0"> Reserved</h4>
                        <p class="card-category"> These are the Reserved Spaces</p>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead class="">
                              <th>
                                Location
                              </th>
                              <th>
                                Street
                              </th>
                              <th>
                                Category
                              </th>
                              <th>
                                Client
                              </th>
                              <th>
                                Duration(In Months)
                              </th>
                              <th>
                                Amount due.
                              </th>
                              <th class="text-right">
                                Actions
                              </th>
                            </thead>
                            <tbody>
                              @foreach ($reserves as $reserve)
                                
                                 <tr>
                                  <td>
                                    {{$reserve->space->location}}
                                  </td>
                                  <td>
                                    {{$reserve->space->street}}
                                  </td>
                                  <td>
                                    {{$reserve->space->category}}
                                  </td>
                                  <td>
                                    {{$reserve->organisation}}
                                  </td>
                                  <td>
                                    {{$reserve->duration}}
                                  </td>
                                 
                                 
                                    <td class="text-primary"> 
                                        @if($reserve->duration >=3 )
                                            {{$reserve->space->price*($reserve->duration*28*0.9)}} 
                                        @elseif(($reserve->duration >= 6) &&($reserve->duration <= 10))
                                          {{$reserve->space->price*($reserve->duration*28*0.8)}}
                                        @elseif($reserve->duration >= 11)
                                          {{$reserve->space->price*($reserve->duration*28*0.7)}}
                                        @else
                                          {{$reserve->space->price*$reserve->duration*28}} 
                                       @endif                                 
                                    </td>
                                   <td class="td-actions text-right">

                                  <div class="dropdown">
                                          <a class="btn btn-sm btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             . . .
                                           </a>
                                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <form method="post" action="{{ route('unreserve', $reserve) }}" autocomplete="off" class="form-horizontal">
                                              @csrf
                                              @method('delete')
                <!-- find a way to unreserve.. this will destroy the client and unreserve the space -->
                                            <a class="dropdown-item" href="{{ route('unreserve', $reserve) }}">{{ __('Unreserve') }}</a>
                                         </form>                                                                             
                                         <form action="{{ route('unreserve', $reserve) }}" method="post">
                                               @csrf
                                               @method('delete')
                                              <a class="dropdown-item" href="{{ route('reserve.edit', $reserve) }}">{{ __('Ediit Infomation') }}</a>                               
                                              <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to unreserve this space ?") }}') ? this.parentElement.submit() : ''">
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
                  @else
                    <div class="row">
                      {{'No RESEVED ONes'}}
                    </div>
                  @endif
                       

                </div>        
    </div>
</div>
@endsection

