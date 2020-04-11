@extends('layouts.app', ['page' => __('Record Management'), 'pageSlug' => 'Records'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Record Managment') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('records.index') }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('records.update', $record) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('no_plate') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Plate') }}</label>
                                    <input type="text" name="no_plate" id="input-name" class="form-control form-control-alternative{{ $errors->has('no_plate') ? ' is-invalid' : '' }}" placeholder="{{ old('no_plate', $record->no_plate)}}" value="{{ old('no_plate', $record->no_plate) }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-email" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ old('name', $record->name) }}" value="{{ old('name', $record->name) }}" required>
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>
                                <div class="form-group{{ $errors->has('space_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-space_id">{{ __('Space id') }}</label>
                                    <input type="text" name="space_id" id="input-space_id" class="form-control form-control-alternative{{ $errors->has('space_id') ? ' is-invalid' : '' }}" placeholder="{{old('space_id', $record->space_id)}}" value="{{old('space_id', $record->space_id)}}">
                                    @include('alerts.feedback', ['field' => 'password'])
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
