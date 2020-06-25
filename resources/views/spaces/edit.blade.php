@extends('layouts.app', ['activePage' => 'spaces-edit', 'titlePage' => __('Edit Spaces')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('spaces.update',$space) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Detials') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('spaces.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Location') }}</label>
                  <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                       <input type="text" name="location" id="location" class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}" placeholder="{{ old('location', $space->location)}}" value="{{ old('location', $space->location) }}" required autofocus>
                                    
                 </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Street') }}</label>
                  <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('street') ? ' has-danger' : '' }}">
                       <input type="text" name="street" id="street" class="form-control form-control-alternative{{ $errors->has('street') ? ' is-invalid' : '' }}" placeholder="{{ old('street', $space->street)}}" value="{{ old('street', $space->street) }}" required autofocus>
                                    
                 </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Price') }}</label>
                  <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                    <input type="text" name="price" id="input-price" class="form-control form-control-alternative{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="{{ old('price', $space->price) }}" value="{{ old('price', $space->price) }}" required>             
                 </div> 
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-category">{{ __(' category') }}</label>
                  <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                       <input type="text" name="category" id="category" class="form-control form-control-alternative{{ $errors->has('category') ? ' is-invalid' : '' }}" placeholder="{{ old('category', $space->category)}}" value="{{ old('category', $space->category) }}" required autofocus>
                                    
                 </div> 
                 <div class="text-center">
                     <button type="submit" class="btn btn-success mt-4">{{ __('Submitt') }}</button>
                 </div>
                  </div>
                </div>
              </div>
              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection