@extends('layouts.app', ['page' => __('Record Management'), 'pageSlug' => 'Record Management'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('Record Management') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('records.create') }}" class="btn btn-sm btn-primary">{{ __('Book') }}</a>
                        </div>
                    </div>
                </div>
                @if (count($errors) > 0)
                     <div class="alert alert-danger">
                         <ul>
                            @foreach ($errors->all() as $error)
                                 <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @include('alerts.success')
                    @if(session()->has('message'))
                      <div class="alert alert-success">
                     {{ session()->get('message') }}
                 </div>
                    @endif

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">{{ __('Plate') }}</th>
                                <th scope="col">{{ __('Space id') }}</th>
                                <th scope="col">{{ __('Duration') }}</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($records as $record)
                                @php
                                //dif for humans
                                  $x= $record->created_at;
                                  $y=$record->deleted_at;
                                  $n= now();
                                  if (empty($y)==true ) {
                                      $diff=$n->diffInSeconds($n);
                                  } else {
                                    $diff = $x->diffInSeconds($y);
                                  } 
                                                                 
                                @endphp 

                                <tr>
                                        <td>{{ $record->no_plate }}</td>
                                       
                                        <td>{{ $record->space_id }}</td>

                                        <td>{{$diff}}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    
                                                        <form action="{{ route('records.destroy', $record) }}" method="post">
                                                            @csrf
                                                            @method('delete')

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
                <div class="card-footer py-4">
                    {{-- <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $users->links() }}
                    </nav> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
