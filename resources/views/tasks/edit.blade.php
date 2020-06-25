@extends('layouts.app', ['activePage' => 'tasks-edit', 'titlePage' => __('Request Tow ')])
@php
$plate= str_split($task->no_plate,3);   
@endphp
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('tasks.update', $task) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Enter vehicle details') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Plate') }}</label>
                  <div class="col-sm-7">
                  <div class="input-group">
                  <input type="text" name="preffix" max="3" class="form-control" placeholder="" value="{{$plate[0]}}"/>
                    @if ($errors->has('preffix'))
                        <span id="email-error" class="error text-danger" for="input-numeric">{{ $errors->first('numeric') }}</span>
                      @endif
                    <span class="input-group-addon">--</span>
                  <input type="text" name="numeric" max="3" class="form-control" placeholder="" value="{{$plate[1]}}"/>
                    @if ($errors->has('numeric'))
                        <span id="email-error" class="error text-danger" for="input-numeric">{{ $errors->first('numeric') }}</span>
                      @endif
                    <span class="input-group-addon">--</span>
                    <input type="text" name="suffix" max="1" class="form-control" placeholder="" value="{{$plate[2]}}"/>
                    @if ($errors->has('suffix'))
                        <span id="email-error" class="error text-danger" for="input-numeric">{{ $errors->first('numeric') }}</span>
                      @endif
                  </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('numeric') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('Numeric ') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('name') }}" value="{{$task->name }}" required />
                      @if ($errors->has('name'))
                        <span id="email-error" class="error text-danger" for="input-numeric">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Phone Number') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('numeric') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('Numeric ') ? ' is-invalid' : '' }}" name="phone" id="input-phone" type="text" placeholder="{{ $task->phone }}" value="{{ $task->phone }}" required />
                      @if ($errors->has('phone'))
                        <span id="email-error" class="error text-danger" for="input-numeric">{{ $errors->first('phone') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('Numeric ') ? ' is-invalid' : '' }}" name="email" id="input-email" type="text" placeholder="Email / optional" value="{{ $task->email }}"  />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-numeric">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-location">{{ __(' Curent location') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" input type="location" name="location" id="input-location" placeholder="" value="{{$task->location}}" required />
                      @if ($errors->has('location'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('location') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-destination">{{ __(' Enter destination') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('destination') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('destination') ? ' is-invalid' : '' }}" input type="destination" name="destination" id="input-destination" placeholder="{{ __('Enter you would like to be taken to') }}" value="{{$task->destination}}" required />
                      @if ($errors->has('destination'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('destination') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
               
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Submitt') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection