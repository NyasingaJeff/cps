<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
  <a href="{{route('home')}}" class="simple-text logo-normal">
      {{ __('cars packing system') }}
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
      @can('admin')
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
            <li class="nav-item{{ $activePage == 'crime-index' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('crimes.index') }}">
                <span class="sidebar-mini"> CRM </span>
                <span class="sidebar-normal"> {{ __('Punishable crimes') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == ('crime-create' )? ' active' : '' }}">
              <a class="nav-link" href="{{ route('crimes.create') }}">
                <span class="sidebar-mini"> CRM </span>
                <span class="sidebar-normal"> {{ __('Add new') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == ('clients-index' )? ' active' : '' }}">
              <a class="nav-link" href="{{ route('clients.index') }}">
                <span class="sidebar-mini"> VC </span>
                <span class="sidebar-normal">{{ __('View all Clients') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      @endcan
      @can('spaces')
      <li class="nav-item {{  ($activePage == 'space') ? ' active' : '' }}">
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
            <li class="nav-item{{ $activePage == ('spaces-index' )? ' active' : '' }}">
              <a class="nav-link" href="{{ route('spaces.index') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('View Spaces') }} </span>
              </a>
            </li>

          </ul>
        </div>
      </li>
      @endcan
      @can('tasks')
      <li class="nav-item{{ $activePage == ('tasks-index' )? ' active' : '' }}">
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
                <span class="sidebar-normal"> {{ __('Tow A Client') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == ('tasks-index' )? ' active' : '' }}">
              <a class="nav-link" href="{{ route('tasks.index') }}">
                <span class="sidebar-mini"> VR </span>
                <span class="sidebar-normal">{{ __('View Requests') }} </span>
              </a>
            </li>

          </ul>
        </div>
      </li>
      @endcan
      @can('records')
      <li class="nav-item{{ $activePage == ('records-index' )? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#recordOptions" aria-expanded="true">
        <i class="material-icons">content_paste</i>
          <p>{{ __('Records') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="recordOptions">
          <ul class="nav">
            <li class="nav-item{{ $activePage == ('records-create' )? ' active' : '' }}">
              <a class="nav-link" href="{{ route('records.create') }}">
                <span class="sidebar-mini"> PV </span>
                <span class="sidebar-normal"> {{ __('Park Vehicle') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == ('records-index' )? ' active' : '' }}">
              <a class="nav-link" href="{{ route('records.index') }}">
                <span class="sidebar-mini"> VR </span>
                <span class="sidebar-normal">{{ __('View all Records') }} </span>
              </a>
            </li>
            
           

          </ul>
        </div>
      </li>
      @endcan    
    </ul>
  </div>
</div>