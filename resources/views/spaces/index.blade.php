@extends('layouts.app', ['page' => __('Parking Space Management'), 'pageSlug' => 'users'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('Spaces') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('spaces.create') }}" class="btn btn-sm btn-primary">{{ __('New Space') }}</a>
                        </div>
                    </div>
                </div>
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
                                <th scope="col">{{ __('Space id ') }}</th>
                                <th scope="col">{{ __('location') }}</th>
                                <th scope="col">{{ __('Price') }}</th>
                                <th scope="col">{{ __('status') }}</th>
                               
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($spaces as $space)
                                    @php
                                    
                                        $a=$space->status;
                                        if ($a==1) {
                                            $s='Free';
                                        } elseif ($a==2) {
                                            $s='Engaged';
                                        }                                  
                                            
                                    @endphp
                                    <tr>
                                        <td>{{ $space->id }}</td>
                                       
                                        <td>{{ $space->location }}</td>

                                        <td>{{$space->price}}</td>

                                        <td>{{$s}}</td>

                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    
                                                        <form action="{{ route('spaces.destroy', $space) }}" method="post">
                                                            @csrf
                                                            @method('delete')

                                                            <a class="dropdown-item" href="{{ route('spaces.edit', $space) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this space?") }}') ? this.parentElement.submit() : ''">
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
