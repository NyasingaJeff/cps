@extends('layouts.app', ['activePage' => 'spaces', 'titlePage' => __('Space List')])

@section('content')
<div class="content">
    <div class="container-fluid">
                <div class="row">
                    @foreach ($spaces as $key => $value )
                    <h3>{{$key}}</h3>
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
                              </tr>
                              @endif
                            
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
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
                                </tr>
                                 @endif
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                    @endforeach      

                </div>        
    </div>
</div>
@endsection

