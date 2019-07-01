<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GG Bulk SMS') }}</title>
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <title> GG Bulk SMS </title>
</head>
<body>
<div id="app">
    <header>
        <nav class="navbar navbar-expand-md bg-primary fixed-top">
            <!-- Brand -->
            <a class="navbar-brand text-white" href="#">Go-SMS</a>
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#"> Pricing </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#"> How to use </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#"> About us </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Terms&Conditions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#"> Contact Us</a>
                    </li>


                </ul>

            </div>
            <a class="nav-link text-white pull-right" href="{{ route("login") }}"> Sign in </a>
        </nav>
    </header>
</div>
<div class="row">
    <div class="container-fluid">
            @yield('content')
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
