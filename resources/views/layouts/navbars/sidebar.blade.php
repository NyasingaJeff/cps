<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
  <a href="{{route('home')}}" class="simple-text logo-normal">
      {{ __('Car Parking System') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExamples" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Admin Roles') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExamples">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{  (request()->segment(1)=='spaces') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#spaceOptions" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Spaces') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="spaceOptions">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'spaces-create' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('spaces.create') }}">
                <span class="sidebar-mini"> +SP </span>
                <span class="sidebar-normal"> {{ __('Add Spaces') }} </span>
              </a>
            </li>
            <li class="nav-item{{ (request()->segment(1)=='spaces' && request()->segment(0)=='index') ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('spaces.index') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('View Spaces') }} </span>
              </a>
            </li>

          </ul>
        </div>
      </li>
      <li class="nav-item {{  (request()->segment(1)=='tasks') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#taskOptions" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Requests') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="taskOptions">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'tasks-create' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('tasks.create') }}">
                <span class="sidebar-mini"> RT </span>
                <span class="sidebar-normal"> {{ __('Request Tow') }} </span>
              </a>
            </li>
            <li class="nav-item{{ (request()->segment(1)=='tasks' && request()->segment(0)=='index') ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('tasks.index') }}">
                <span class="sidebar-mini"> VR </span>
                <span class="sidebar-normal">{{ __('View Requests') }} </span>
              </a>
            </li>

          </ul>
        </div>
      </li>

      <li class="nav-item {{  (request()->segment(1)=='records') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#recordOptions" aria-expanded="true">
        <i class="material-icons">content_paste</i>
          <p>{{ __('Records') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="recordOptions">
          <ul class="nav">
            <li class="nav-item{{(request()->segment(1)=='records') ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('records.create') }}">
                <span class="sidebar-mini"> PV </span>
                <span class="sidebar-normal"> {{ __('Park Vehicle') }} </span>
              </a>
            </li>
            <li class="nav-item{{(request()->segment(1)=='records') ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('records.index') }}">
                <span class="sidebar-mini"> VR </span>
                <span class="sidebar-normal">{{ __('View all Records') }} </span>
              </a>
            </li>
           

          </ul>
        </div>
      </li>
      



      <li class="nav-item{{ (request()->segment(1)=='records') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('records.index') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Records') }}</p>
        </a>
      </li>

 
    
    </ul>
  </div>
</div>