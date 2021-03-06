@extends('layouts.app', ['activePage' => 'search', 'titlePage' => __('results')])

@section('content')
<div class="content">
<div class="col-md-12">
    <div class="col-md-12 text-right">
        <a href={{ url()->previous() }} class="btn btn-sm btn-primary">{{ __('Back') }}</a>
    </div>
        <div class="card card-plain">
            
          <div class="card-header card-header-primary">
            <h4 class="card-title mt-0"> Results for for {{$query->searchinput}} </h4>
           
            <p class="card-category">Displaying  {{count($result)}}  records</p>            
          </div>
         
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                @if ($origin=="users")
                    <thead class="">
                        <th>
                          Name
                        </th>
                        <th>
                          Role
                        </th>
                    
                    </thead>
                    <tbody>
                      @foreach ($result as $result)
                      <tr>
                      <td>
                      {{$result->name}}
                      </td>
                      <td class="text-primary ">
                        <!-- use logic to get the Role the Employee Has -->
                        @if($result->hasRole('tower'))
                          {{'Tower'}}
                        @elseif($result->hasRole('attendant'))
                          {{'Attendant'}}
                        @endif
                      </td>
                      <td class="text-right">
                          <a href={{ route('user.edit',$result) }} class="btn btn-sm btn-success">{{ __('Edit') }}</a>
                      </td>                                             
                      </tr>
                  @endforeach
                    </tbody>
                @else
                <thead class="">
                  <th>
                    Plate
                  </th>
                  <th>
                    Client Name
                  </th>

                </thead>
                    <tbody>

                      
                    
                @switch($origin)
                    @case('records')
                        @foreach ($result as $result)
                            <tr>
                            <td>
                            {{$result->no_plate}}
                            </td>
                            <td>
                            {{$result->name}}
                            </td>
                            <td class="text-right">
                                <a href={{ route('records.index',$result) }} class="btn btn-sm btn-primary">{{ __('Show') }}</a>
                            </td>                                             
                            </tr>
                        @endforeach                         
                    @break
                    @case('clients')
                        @foreach ($result as $result)
                            <tr>
                            <td>
                            {{$result->no_plate}}
                            </td>
                            <td>
                            {{$result->name}}
                            </td>
                            <td  class="text-right">
                                <a href={{ route('clients.show',$result) }} class="btn btn-sm btn-primary">{{ __('Show') }}</a>
                            </td>                                             
                            </tr>
                        @endforeach                       
                    @break
                    @case('requests')
                        @foreach ($result as $result)
                            <tr>
                            <td>
                            {{$result->no_plate}}
                            </td>
                            <td>
                            {{$result->name}}
                            </td>
                            <td class="text-right">
                                <a href={{ route('tasks.show',$result) }} class="btn btn-sm btn-primary">{{ __('Show') }}</a>
                            </td>                                             
                            </tr>
                        @endforeach      
                    @break
                    
                    @default
                        
                @endswitch
                
                </tbody>                    
                @endif
              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</div>  
@endsection