@extends('layouts.app', ['page' => __('Parking Spaces Management'), 'pageSlug' => 'spaces'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Edit space information') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('spaces.index') }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('spaces.update', $space) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('parking space information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('space') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="location">{{ __('location') }}</label>
                                    <input type="text" name="location" id="location" class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}" placeholder="{{ old('location', $space->location)}}" value="{{ old('location', $space->location) }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'location'])
                                </div>
                                <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-price">{{ __('price') }}</label>
                                    <input type="text" name="price" id="input-price" class="form-control form-control-alternative{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="{{ old('price', $space->price) }}" value="{{ old('price', $space->price) }}" required>
                                    @include('alerts.feedback', ['field' => 'price'])
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
    </div>
@endsection
