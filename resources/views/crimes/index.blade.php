@extends('layouts.app', ['activePage' => 'cromem-management', 'titlePage' => __('Crime Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Crimes') }}</h4>
                <p class="card-category"> {{ __('Crimes Punishable by law') }}</p>
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
                    <a href="{{ route('crimes.create') }}" class="btn btn-sm btn-primary">{{ __('Add Others') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          {{ __('Crime') }}
                      </th>
                      <th>
                        {{ __('Fine') }}
                      </th>
                      <th>
                        {{ __('Added On') }}
                      </th>
                      <th>
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($crimes as $crime)                                    
                                            
                        <tr>
                          <td>
                            {{ $crime->name }}
                          </td>
                          <td>
                            {{ $crime->fine }}
                          </td>
                          <td>
                            {{ $crime->created_at->format('Y-m-d H:i:s') }}
                          </td>
                          
                          <td class="td-actions text-right">

                            <div class="dropdown">
                              <a class="btn btn-sm btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 . . .
                               </a>
                             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">                                                                                          
                                                        
                                <form action="{{ route('crimes.destroy', $crime) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a class="dropdown-item" href="{{ route('crimes.edit', $crime) }}">{{ __('Edit') }}</a>
                                  <a class="dropdown-item" href="{{ route('crimes.show', $crime) }}">{{ __('Description') }}</a>
                                  <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to do Away with this?") }}') ? this.parentElement.submit() : ''">
                                  {{ __('Do Away With') }}
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