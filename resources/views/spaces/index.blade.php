@extends('layouts.app', ['activePage' => 'spaces', 'titlePage' => __('Space List')])

@section('content')
<div class="content">
    <div class="container-fluid">
                <div class="row">
                    <!-- $key represents the towns that the spaces are located this loop is to iterate through all thhe locations  -->
                    @foreach ($spaces as $town => $slots )
                    <h3 class= text-center>{{$town}}</h3>
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
                                ID
                              </th>
                              <th>
                                Category
                              </th>
                              <th>
                                Street
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
                              @foreach ($slots as $slot)
                              
                              @if ($slot->status==0)
                              <tr>
                                <td>
                                  {{$slot->id}}
                                </td>
                                <td>
                                  {{$slot->category}}
                                </td>
                                <td>
                                  {{$slot->street}}
                                </td>
                                <td>
                                  {{$count= $slot->record->count() }}
                                </td>
                                <td class="text-primary">
                                  {{$count*$slot->price}}
                                </td>
                              <td class="td-actions text-right">

                                  <div class="dropdown">
                                  <a class="btn btn-sm btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      . . .
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                      <form method="post" action="{{ route('spaces.edit', $slot) }}" autocomplete="off" class="form-horizontal">
                                        @csrf
                                        @method('put')
                                        <a class="dropdown-item" href="{{ route('space.reserve', $slot) }}">{{ __('Reserve') }}</a>


                                      </form>
                                                                      
                                                        
                                <form action="{{ route('spaces.destroy', $slot) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a class="dropdown-item" href="{{ route('spaces.edit', $slot) }}">{{ __('Edit') }}</a>                               
                                  <a class="dropdown-item" href="{{ route('spaces.show', $slot) }}">{{ __('View') }}</a>                               
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
                  @if($reservedcount != 0)
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
                                ID
                              </th>
                              <th>
                                Category
                              </th>
                              <th>
                                Client
                              </th>
                              <th>
                                Duration
                              </th>
                              <th>
                                Amount due.
                              </th>
                              <th class="text-right">
                                Actions
                              </th>
                            </thead>
                            <tbody>
                              @foreach ($slots as $slot)
                                 @if ($slot->status==1)
                                 <tr>
                                  <td>
                                    {{$slot->id}}
                                  </td>
                                  <td>
                                    {{$slot->category}}
                                  </td>
                                  <td>
                                    {{$slot->created_at}}
                                  </td>
                                  <td>
                                    {{$slot->price}}
                                  </td>
                                  <td class="text-primary">
                                    $36,738
                                  </td>

                                   <td class="td-actions text-right">

                                  <div class="dropdown">
                                          <a class="btn btn-sm btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             . . .
                                           </a>
                                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <form method="post" action="{{ route('spaces.edit', $town) }}" autocomplete="off" class="form-horizontal">
                                              @csrf
                                              @method('put')
                <!-- find a way to unreserve.. this will destroy the client and unreserve the space -->
                                            <a class="dropdown-item" href="{{ route('clients.create', $town) }}">{{ __('Unreserve') }}</a>
                                         </form>                                                                             
                                         <form action="{{ route('spaces.destroy', $town) }}" method="post">
                                               @csrf
                                               @method('delete')
                                              <a class="dropdown-item" href="{{ route('spaces.edit', $town) }}">{{ __('Edit') }}</a>                               
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
                  @endif
                    @endforeach      

                </div>        
    </div>
</div>
@endsection

