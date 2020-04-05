@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Material Dashboard')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <h1 class="text-white text-center">{{ __('Welcome to the Online Car Parking Platform') }}</h1>
      <a class="btn btn-primary" href="{{route('records.create')}}" role="button">Park</a>
      <a class="btn btn-warning" href="{{route('tasks.create')}}" role="button">Request Tow</a> <br>
      </div>
  </div>
</div>
@endsection
