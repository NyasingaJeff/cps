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
                      <input class="form-control{{ $errors->has('name ') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name of new Role') }}" value="{{ old('') }}" required />
                      @if ($errors->has('name'))
                        <span id="email-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="role">{{ __('Permissions') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                    <input type="radio" id="admin" name="permission" value="admin">
                      <label for="male">Admin</label>
                      <input type="radio" id="attendant" name="permission" value="attendant">
                      <label for="female">Attendant</label>
                      <input type="radio" id="tower" name="permission" value="tower">
                      <label for="other">Tower</label>
                    </div>
                  </div>
                </div>
                
                     
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Register Role') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection