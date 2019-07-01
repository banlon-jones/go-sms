@extends('layouts.app')

@section('content')
        <div class="row">

                <div class="col-md-5">
                    <!-- Card Wider -->
                    <div class="card card-cascade wider">
                        <!-- Card image -->
                        <div class="view view-cascade overlay">
                            <img src="{{ asset("storage/$user->profile") }}" class="img-responsive" height="320" width="auto">
                            <a href="#!">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade">
                            <h3> user profile </h3>
                            <p> <i class="fa fa-user"></i> Name : {{ $user->name }} </p>
                            <p> <i class="fa fa-envelope-o"></i>  Email : {{ $user->email }} </p>
                            <p> <i class="fa fa-phone"></i> Phone number : {{ $user->phone }} </p>
                            <p> <i class="fa fa-location-arrow"></i> Town/City : {{ $user->city }} </p>
                            <p> <i class="fa fa-street-view"></i> Status :
                                @if ($user->status == 0)
                                    {{ 'unverified' }}
                                @else
                                    {{ 'verified' }}

                                @endif
                            </p>
                            <div class="text-center">
                                <a href="" class="btn btn-info btn-sm" ><span class="fa fa-pencil"></span> Edit </a>
                            </div>
                        </div>

                    </div>
                    <!-- Card Wider -->
                </div>
                <div class="col-md-7">
                    <!-- Card -->
                    <div class="card">

                        <!-- Card image -->
                        <img src="{{ asset("storage/$user->verification_doc") }}" class="img-responsive" height="450" width="auto">

                        <!-- Card content -->
                        <div class="card-body text-center">

                            <!-- Title -->
                            <h4 class="card-title"><a>verification document </a></h4>
                            <!-- Text -->
                            @if ($user->status == 0)
                                <a onclick="
                                document.getElementById('validation').submit();
                                        " class="btn btn-success"> Validate </a>
                                <form id="validation" method="post" action="/users/{{ $user->id }}/verify" style="display: none">
                                    {{csrf_field()}}
                                    <input type="hidden" name="status" value="1">
                                </form>
                            @else
                                <a onclick="
                                document.getElementById('validation').submit();
                                        " class="btn btn-danger"> Suspend account </a>
                                <form id="validation" method="post" action="/users/{{ $user->id }}/suspend" style="display: none">
                                    {{csrf_field()}}
                                    <input type="hidden" name="status" value="0">
                                </form>

                            @endif


                        </div>

                    </div>
                </div>

        </div>
@endsection
