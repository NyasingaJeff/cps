@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Park your Vehicle')])

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
                  <label class="col-sm-2 col-form-label">{{ __('Number Plate Preffix') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('prefix') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('preffix') ? ' is-invalid' : '' }}" name="preffix" id="input-name" type="text" placeholder="{{ __('KXX') }}" value="{{ old('') }}" required="true" aria-required="true"/>
                      @if ($errors->has('preffix'))
                        <span id="name-error" class="error text-danger" for="input-prefix">{{ $errors->first('preffix') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Numeric') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('numeric') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('numeric') ? ' is-invalid' : '' }}" name="numeric" id="input-numeric" type="text" placeholder="{{ __('000') }}" value="{{ old('') }}" required />
                      @if ($errors->has('numeric'))
                        <span id="email-error" class="error text-danger" for="input-numeric">{{ $errors->first('numeric') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-suffix">{{ __(' suffix') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('suffix') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('suffix') ? ' is-invalid' : '' }}" input type="suffix" name="suffix" id="input-suffix" placeholder="{{ __('x') }}" value="" required />
                      @if ($errors->has('suffix'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('suffix') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
               
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Add User') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection