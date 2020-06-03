@extends('layouts.app', ['activePage' => 'crime-management', 'titlePage' => __('Add another possible Crime')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('rolespermission.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Enter the Role name and the permissions it has') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name ') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('name') }}" value="{{ old('') }}" required />
                      @if ($errors->has('name'))
                        <span id="email-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-description">{{ __(' Description ') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }} " input type="description" name="description" id="input-description" placeholder="{{ __('Describe briefly....') }}" value="" required />
                      @if ($errors->has('description'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-fine">{{ __(' Fine ') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('fine') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('fine') ? ' is-invalid' : '' }}" input type="fine" name="fine" id="input-fine" placeholder="{{ __('Fine....') }}" value="" required />
                      @if ($errors->has('fine'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('fine') }}</span>
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