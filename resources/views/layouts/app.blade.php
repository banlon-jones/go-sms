<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GO-SMS') }}</title>
<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">

    <!-- css spinner -->
    <link href="{{asset("css/addons/main.css")}}" rel="stylesheet">
    <link href="{{asset("css/addons/normalize.css")}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset("js/addons/modernizr-2.6.2.min.js")}}"></script>
    <title> GO SMS </title>
</head>
<body>
<div id="preloader"></div>
<div id="app">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark text-white primary-color fixed-top mb-3">

        <!-- SideNav slide-out button -->
        <a class="navbar-brand" href="/home"> GO-SMS Dashboard</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item ">
                        <a class="nav-link waves-effect waves-light" href="{{ route('login') }}">
                            <i class="fa fa-sign-in"></i> Login
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link waves-effect waves-light" href="{{ route('register') }}">
                            <i class="fa fa-pencil-square"></i> Register
                        </a>
                    </li>
                @else

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class="fa fa-user"></i>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                            <a class="dropdown-item waves-effect waves-light" href="/transactions">My receipes</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>

                    </li>
                @endguest
            </ul>
        </div>
        </nav>
    </header>
</div>
<br>
<br>
<div class="row">
    <div class="col-md-2">
        <!--Main Navigation-->
        @include('layouts.navbar')

    </div>
    <div class="col-md-10 col-0">
        <br>
            <div class="flash_message">
                @include('partials.success')
                @include('partials.error')
            </div>
            <div class="container-fluid">
                @yield('content')
            </div>
    </div>
</div>
    <!-- Scripts -->
<!-- Tooltips -->
<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>

<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
<script>
  // Material Select Initialization
$(document).ready(function() {
   $('.mdb-select').material_select();
 });
</script>

</body>
</html>
