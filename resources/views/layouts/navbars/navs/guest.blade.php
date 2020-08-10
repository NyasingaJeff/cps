<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <div class=" well " style="background:purple; border: solid; border-color:purple; border-radius:10px;">
        <a class="navbar-brand" href="/"><i class="fa fa-taxi" aria-hidden="true"></i>  CAR PARK SYSTEM</a>
      </div>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">        
        <li class="nav-item">
          <a href="{{ route('login') }}" class="nav-link">
            <button class="btn btn-outline-primary" style="color: white; "> {{ __('Login') }}</button> 
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->