@extends('layouts.app', ['activePage' => 'records-create', 'titlePage' => __('Reserved Spaces Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post"  action="{{ route('space.reservation') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Reserve Space') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('spaces.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Space ID') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('space_id') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('space_id') ? ' is-invalid' : '' }}" name="space_id" id="input-space_id" type="text" placeholder="{{ __($space->id) }}" value="{{ old('', $space->st_id) }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="space_id-error" class="error text-danger" for="input-space_id">{{ $errors->first('space_id') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-organisation">{{ __(' Orgarnisation') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('organisation') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('organisation') ? ' is-invalid' : '' }}" input type="text" name="organisation" id="input-organisation" placeholder="{{ __('organisation') }}" required/>
                      @if ($errors->has('password'))
                        <span id="organisation-error" class="error text-danger" for="input-organisation">{{ $errors->first('organisation') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="" required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Duration') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="duration" id="input-duration" type="text" placeholder="{{ __('Duration in months') }}" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-success">{{ __('Reserve') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection