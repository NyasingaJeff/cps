@extends('layouts.app', ['activePage' => 'records-create', 'titlePage' => __('Park your Vehicle')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('records.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Enter vehicle details') }}</h4>
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
                  <div class="input-group">
                    <input type="text" name="preffix" max="3" class="form-control" placeholder="KXX"/>
                    @if ($errors->has('preffix'))
                        <span id="email-error" class="error text-danger" for="input-numeric">{{ $errors->first('numeric') }}</span>
                      @endif
                    <span class="input-group-addon">--</span>
                    <input type="text" name="numeric" max="3" class="form-control" placeholder="000"/>
                    @if ($errors->has('numeric'))
                        <span id="email-error" class="error text-danger" for="input-numeric">{{ $errors->first('numeric') }}</span>
                      @endif
                    <span class="input-group-addon">--</span>
                    <input type="text" name="suffix" max="1" class="form-control" placeholder="X"/>
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
                      <input class="form-control{{ $errors->has('Numeric ') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('name') }}" value="{{ old('') }}" required />
                      @if ($errors->has('name'))
                        <span id="email-error" class="error text-danger" for="input-numeric">{{ $errors->first('numeric') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-phone">{{ __(' Phone Number ') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" input type="phone" name="phone" id="input-phone" placeholder="{{ __('07xxxxxxxx') }}" value="" required />
                      @if ($errors->has('phone'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('phone') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-space_id">{{ __(' Space Id ') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('space_id') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('space_id') ? ' is-invalid' : '' }}" input type="space_id" name="space_id" id="input-space_id" placeholder="{{ __('Nk1') }}" value="" required />
                      @if ($errors->has('space_id'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('space_id') }}</span>
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