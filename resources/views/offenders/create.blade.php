@extends('layouts.app', ['activePage' => 'clamp-management', 'titlePage' => __('Clamp')])
@php
    $a= $record->space->st_id;
    $a= str_split($a , '4');                       
@endphp
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post"  action="{{ route('records.offender') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Clamp Offender') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('records.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Plate') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('no_plate') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('no_plate') ? ' is-invalid' : '' }}" name="no_plate" id="input-no_plate" type="text" placeholder="{{ __($record->no_plate) }}" value="{{ old('', $record->no_plate) }}" required="true" aria-required="true"/>
                      @if ($errors->has('no_plate'))
                        <span id="no_plate-error" class="error text-danger" for="input-no_plate">{{ $errors->first('no_plate') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-location">{{ __(' Location') }}</label>
                  <div class="col-sm-7">
                  
                    <div class="form-group{{ $errors->has('location')? ' has-danger' : '' }}"required>
                    <div class="input-group">
                    <input type="text" name="town" max="3" class="form-control" value="{{ __($record->space->location)}} -" />
                    @if ($errors->has('preffix'))
                        <span id="town-error" class="error text-danger" for="input-numeric">{{ $errors->first('town') }}</span>
                      @endif
                    <span class="input-group-addon"> <label>Street:&nbsp &nbsp </label></span>
                    <input type="text" name="street" max="3" class="form-control" value="{{ __($record->space->street)}} - "/>
                    @if ($errors->has('street'))
                        <span id="email-error" class="error text-danger" for="input-street">{{ $errors->first('street') }}</span>
                      @endif
                      <span class="input-group-addon"> <label>Slot :&nbsp &nbsp </label></span>
                    <input type="text" name="slot_no" max="1" class="form-control" value="{{ $a[1]}}"/>
                    @if ($errors->has('slot_no'))
                        <span id="email-error" class="error text-danger" for="input-slot_no">{{ $errors->first('slot_no') }}</span>
                      @endif
                  </div>
                      
                    </div>
                  </div>
                </div>
                
               
                
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Make') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="make" id="input-make" type="text" placeholder="{{ __('Make') }}"  />
                    </div>
                  </div>
                </div>
               
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="">{{ __('Model') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="model" id="input-model" type="text" placeholder="{{ __('Model') }}"  />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="">{{ __('Color') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="color" id="input-color" type="text" placeholder="{{ __('Color') }}"  />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Offence') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="crime_id" id="input-offence" type="text" placeholder="{{ __('Offence') }}" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-danger">{{ __('Clamp') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection