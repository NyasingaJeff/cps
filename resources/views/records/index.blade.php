@extends('layouts.app', ['activePage' => 'record-management', 'titlePage' => __('Records Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Records') }}</h4>
                <p class="card-category"> {{ __('Here you can manage records') }}</p>
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
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('records.create') }}" class="btn btn-sm btn-primary">{{ __('Book Space') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          {{ __('Plate') }}
                      </th>
                      <th>
                        {{ __('Name') }}
                      </th>
                      <th>
                        {{ __('Parked at') }}
                      </th>
                      <th>
                        {{ __('Town') }}
                      </th>                     
                     <th class="text-right">
                        {{ __('Street') }}
                      </th>
                      <th class="text-right">
                        {{ __('Spot Number') }}
                      </th>
                      <th class="text-right">
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($records as $record)
                       @php
                       $a= $record->space->st_id;
                       $a= str_split($a , '4');
                       
                       @endphp
                       
                        <tr>
                          <td>
                            {{ $record->no_plate }}
                          </td>
                          <td>
                            {{ $record->name }}
                          </td>
                          <td>
                            {{ $record->created_at->format('Y-m-d H:i:s') }}
                          </td>
                          <td >
                            {{ $record->space->location}}
                          </td>
                          <td class="text-right">
                            {{ $record->space->street}}
                          </td>

                          <td class="text-right">
                            {{ $a[1]}}
                          </td>
                          <td class="td-actions text-right">

                            <div class="dropdown">
                              <a class="btn btn-sm btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 . . .
                               </a>
                             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">                                                                                          
                                                        
                                <form action="{{ route('records.destroy', $record) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a class="dropdown-item" href="{{ route('records.clamp', $record) }}">{{ __('Clamp') }}</a>
                                  <a class="dropdown-item" href="{{ route('records.impound', $record) }}">{{ __('Impound') }}</a>
                                  <a class="dropdown-item" href="{{ route('records.edit', $record) }}">{{ __('Edit') }}</a>
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
    </div>
  </div>
@endsection