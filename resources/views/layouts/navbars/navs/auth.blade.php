<!-- Navbar -->
@php
  
  $user = auth()->user();
  if ($user->hasRole('admin')) {
    # Do Nothing
  } else {
    $notifications = $notifications->filter(function($value,$key){
      return $value->location ==  auth()->user()->location  || explode(',',$value->location)[0] == auth()->user()->location ;
    });
    // to display five a time
  }
  $not_display = $notifications->slice(0,5);

@endphp

<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">

    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    </button>
   
    <div class="collapse navbar-collapse justify-content-end">
    @can('admin')
    <form class="navbar-form" method="post" action="{{route('search')}}">
      @csrf
      @method('post')
        <div class="btn-group">
          <label for="cars">Search In :&nbsp;</label>

          <select name="options" id="options" style=" opacity: 0.4;">
            <option value=""><span >Select Option</span></option>
            <option value="records"><span >Records</span></option>
            <option value="requests"><span >Requests</span></option>
            <option value="clients"><span >Clients</span></option>
            <option value="users"><span >Users</span></option>
            
          </select>
          
        </div>&nbsp;      
        <div class="input-group no-border">
         
        <input type="text" name="searchinput" value="" class="form-control" placeholder="Enter Plate or Name..">
        <button type="submit" class="btn btn-white btn-round btn-just-icon">          
          <i class="material-icons">search</i>
          <div class="ripple-container"></div>
        </button>
        </div>
      </form>
      @endcan
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">
            <i class="material-icons">dashboard</i>
            <p class="d-lg-none d-md-block">
              {{ __('Stats') }}
            </p>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">notifications</i>
              <span class="notification">{{count($notifications)}}</span> 
            <p class="d-lg-none d-md-block">
              {{ __('Some Actions') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
          @foreach ($not_display as $notification)
          <a class="dropdown-item" href="{{route('tasks.index')}}">
            {{$notification->no_plate}} 
             {{$notification->location}} To  : 
        @if ($notification->type ==1 )
            <span style="color: red"> {{$notification->destination}}</span>
        @else
             {{$notification->destination}}
        @endif
          </a>         
          
           @endforeach
          {{-- {{$not_display}} --}}
            
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">person</i>
            <p class="d-lg-none d-md-block">
              {{ __('Account') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
          </div>
        </li>
      </ul>
    </div>
    
  </div>
</nav>

