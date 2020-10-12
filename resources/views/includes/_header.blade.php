<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="#" style="font-family:fantasy;color:darkblue">Movie APP</a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse col-md-8" style="margin-left:140px" id="basicExampleNav">

    <!-- Links -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="/">Home

        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('movie.list')}}">Top Movies</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('upcoming.list')}}">Upcoming</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('tvshow.list')}}">Tv Show</a>
      </li>


    </ul>
    <!-- Links -->

    <form class="form-inline">
      <div class="md-form my-0 searchBox">

                <i class="fa fa-search"></i>
                <span class="searchButton">Search</span>
      </div>
    </form>
  </div>
  <!-- Collapsible content -->

</nav>
