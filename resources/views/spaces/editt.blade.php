@extends('layouts.app', ['activePage' => 'space-management', 'titlePage' => __('Space Edit')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
     
                      
        <div class="col-md-12">
        <form method="post" action="{{ route('spaces.update', $space) }}" autocomplete="off">
             @csrf
            @method('put')

             <h6 class="heading-small text-muted mb-4">{{ __('parking space information') }}</h6>
             <div class="pl-lg-4">
                 <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                       <label class="form-control-label" for="location">{{ __('Location') }}</label>
                       <input type="text" name="location" id="location" class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}" placeholder="{{ old('location', $space->location)}}" value="{{ old('location', $space->location) }}" required autofocus>
                                    
                 </div>
                 <div class="form-group{{ $errors->has('street') ? ' has-danger' : '' }}">
                       <label class="form-control-label" for="street">{{ __('Street') }}</label>
                       <input type="text" name="street" id="street" class="form-control form-control-alternative{{ $errors->has('street') ? ' is-invalid' : '' }}" placeholder="{{ old('street', $space->street)}}" value="{{ old('street', $space->street) }}" required autofocus>
                                    
                 </div>
                 
                 <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-price">{{ __('Price') }}</label>
                    <input type="text" name="price" id="input-price" class="form-control form-control-alternative{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="{{ old('price', $space->price) }}" value="{{ old('price', $space->price) }}" required>             
                 </div>                              
                <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                       <label class="form-control-label" for="category">{{ __('Category') }}</label>
                       <input type="text" name="category" id="category" class="form-control form-control-alternative{{ $errors->has('category') ? ' is-invalid' : '' }}" placeholder="{{ old('category', $space->category)}}" value="{{ old('category', $space->category) }}" required autofocus>
                                    
                 </div> 
        
                 <div class="text-center">
                     <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                 </div>
             </div>
         </form>
        </div>
      </div>
    </div>
  </div>
@endsection