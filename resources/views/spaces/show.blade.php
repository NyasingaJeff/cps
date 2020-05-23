@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
<div class="content">
<div class="col-md-12">
        <div class="card card-plain">
          <div class="card-header card-header-primary">
            <h4 class="card-title mt-0"> Records From {{$space->location}}, {{$space->street}} Street </h4>
            <p class="card-category">Displaying the {{$count}} records</p>            
           <a class="dropdown-item" href="{{ route('spaces.pdf', $space) }}">{{ __('print') }}</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="">
                  <th>
                    Plate
                  </th>
                  <th>
                    Client Name
                  </th>
                  <th>
                    Parking Time
                  </th>
                </thead>
                <tbody>
                @foreach ($records as $record)
                  <tr>
                    <td>
                    {{$record->no_plate}}
                    </td>
                    <td>
                    {{$record->name}}
                    </td>
                    <td class= 'text-primary'>
                    {{$record->created_at->diffForHumans()}}
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