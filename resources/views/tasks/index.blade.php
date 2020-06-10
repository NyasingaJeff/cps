@extends('layouts.app', ['activePage' => 'task-management', 'titlePage' => __('Task Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Submitted Towing Requests') }}</h4>
                <p class="card-category">{{'Displaying'}} {{$tasks->count() }} {{'Records'}}</p>
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
                @endif'
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-primary">{{ __('Request') }}</a>
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
                        {{ __('Location') }}
                      </th>
                      <th>
                        {{ __('Destination') }}
                      </th>                     
                      <th class="text-right">
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($tasks as $task)
                    
                       
                      
                        <tr>
                          <td>
                            {{ $task->no_plate }}
                          </td>
                          <td>
                          @php
                            if (isset($task->client->name)){
                              $name = $task->client->name;
                            }else{
                              $name = 'Not Set';
                            }
                          @endphp
                            {{ $name}}
                          </td>
                          <td>
                            {{ $task->location }}
                          </td>
                          @if ($task->type==0)
                          <td >
                            
                            {{ $task->destination}} 
                          </td>                              
                          @else
                          <td class="text-danger" >
                           
                            {{ $task->destination}} 
                          </td>
                          @endif
                          
                          <td class="td-actions text-right">

                          <div class="dropdown">
                              <a class="btn btn-sm btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 . . .
                               </a>
                             <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">                                                                                          
                                                        
                                <form action="{{ route('tasks.destroy', $task) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a class="dropdown-item" href="{{ route('tasks.do', $task) }}">{{ __('Pick') }}</a>
                                  <a class="dropdown-item" href="{{ route('tasks.edit', $task) }}">{{ __('Edit') }}</a>
                                  <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this Task?") }}') ? this.parentElement.submit() : ''">
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