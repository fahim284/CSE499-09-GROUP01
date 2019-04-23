<!DOCTYPE html>
<html>
<head>
    <title>@section("title") FITNESS: @show</title>
    @section("css")
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    @show
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Fitness</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      @if(!auth()->user())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>

      @else

      <li class="nav-item">
        <a class="nav-link" href="{{ route('profiles.new') }}">Profile</a>
      </li>

      <li class="nav-item">
        <a class="nav-link disabled" href="{{ route('food.add') }}">Add Food</a>
      </li>

      <li class="nav-item">
        <a class="nav-link disabled" href="#">Food History</a>
      </li>

      <li class="nav-item">
        <a class="nav-link disabled" href="{{ route("logout") }}">Logout</a>
      </li>

      <li class="nav-item pull-right">
        <a class="nav-link" href="#">Logged In As {{ auth()->user()->first_name }}</a>
      </li>
      @endif
    </ul>
  </div>
</nav>

<br/> <br/>
    <div class="container">
        <div class="row">
            <div class="col-md-10">

              @if(session("error"))
                <div class="alert alert-danger">{{ session("error") }}</div>
              @endif

                @yield("content")
            </div>
            <div class="col-md-2">
                <h3>Sidebar</h3>
                <hr />
                @yield("sidebar")
            </div>
        </div>
    </div>

    @section("js")
        <script type="text/javascript" src="/js/popper.min.js"></script>
        <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script> 
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    @show
</body>
</html>