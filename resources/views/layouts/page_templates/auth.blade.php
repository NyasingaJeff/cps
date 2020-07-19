<div class="wrapper ">
  @include('layouts.navbars.navs.auth')
  @include('layouts.navbars.sidebar')
  <div class="main-panel">   
    @include('layouts.alerts.flash')
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>