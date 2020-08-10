@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Welcome')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row text-center">
      <div class="col" style="margin-top:5cm;border:solid; border-color:purple; border-radius:10px;">
          <h1 class=" text-center text-white" style="">{{ __('Welcome to the Online Car Parking Platform') }}</h1>
      <a class="btn btn-primary" href="{{route('guest.park')}}" role="button">Park</a>
      <a class="btn btn-warning" href="{{route('guest.request')}}" role="button">Request Tow</a> <br>
      </div>
  </div>
</div>
@endsection
