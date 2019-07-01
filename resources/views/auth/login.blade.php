@extends('layouts.login_nav')

@section('content')
    <style>
        body{
            background-image: url("{{ asset("img/SMS-Marketing-FAQs.jpg") }}");
        }
    </style>
<div class="container">
    <div class="row">
        <div style="margin: 5% 35%;">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="cars-body" style="padding: 32px">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" >E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" >Password</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                                <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-sign-in"></span>
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
