@extends('layouts.app', ['activePage' => 'spaces', 'titlePage' => __('Space List')])

@section('content')
<div class="content">
    <div class="container-fluid">
                <div class="row">
                    @foreach ($spaces as $key => $value )
                    <h3 class= text-center>{{$key}}</h3>
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
                              @foreach ($value as $val)
                              
                              @if ($val->status==0)
                              <tr>
                                <td>
                                  {{$val->id}}
                                </td>
                                <td>
                                  {{$val->category}}
                                </td>
                                <td>
                                  {{$val->street}}
                                </td>
                                <td>
                                  Count
                                </td>
                                {{-- //calculate --}}
                                <td class="text-primary">
                                  $36,738
                                </td>
                             <td class="td-actions text-right">

                            <div class="dropdown">
                              <a class="btn btn-sm btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 . . .
                               </a>
                             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                             <form method="post" action="{{ route('spaces.edit', $val) }}" autocomplete="off" class="form-horizontal">
                                    @csrf
                                     @method('put')
                                     <a class="dropdown-item" href="{{ route('clients.create', $val) }}">{{ __('Reserve') }}</a>


                             </form>
                                                                      
                                                        
                                <form action="{{ route('spaces.destroy', $val) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a class="dropdown-item" href="{{ route('spaces.edit', $val) }}">{{ __('Edit') }}</a>                               
                                  
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
                              @foreach ($value as $val)
                                 @if ($val->status==1)
                                 <tr>
                                  <td>
                                    {{$val->id}}
                                  </td>
                                  <td>
                                    {{$val->category}}
                                  </td>
                                  <td>
                                    {{$val->created_at}}
                                  </td>
                                  <td>
                                    {{$val->price}}
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
                                        <form method="post" action="{{ route('spaces.edit', $key) }}" autocomplete="off" class="form-horizontal">
                                              @csrf
                                              @method('put')
                <!-- find a way to unreserve.. this will destroy the client and unreserve the space -->
                                            <a class="dropdown-item" href="{{ route('clients.create', $key) }}">{{ __('Unreserve') }}</a>
                                         </form>                                                                             
                                         <form action="{{ route('spaces.destroy', $key) }}" method="post">
                                               @csrf
                                               @method('delete')
                                              <a class="dropdown-item" href="{{ route('spaces.edit', $key) }}">{{ __('Edit') }}</a>                               
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

