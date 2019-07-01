@extends('layouts.public_app')

@section('content')
    <!-- Section: Blog v.4 -->
    <section class="my-5">
                <div class="card card-cascade wider reverse">

                    <!-- Card image -->
                    <div class="view view-cascade overlay">
                        <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
                            <!--Indicators-->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-2" data-slide-to="1"></li>
                            </ol>
                            <!--/.Indicators-->
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset("img/bulksms-provider.jpg") }}" alt="First slide" height="550" width="1200">
                                        <div class="mask rgba-black-light"></div>
                                    </div>
                                    <div class="carousel-caption">
                                       <a href="/register" class="btn btn-danger"> Sign Up Now </a>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <!--Mask color-->
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset("img/bulk-sms.jpg") }}" alt="Second slide"height="550" width="1200">
                                        <div class="mask rgba-black-strong"></div>
                                    </div>
                                </div>
                                <div class="carousel-caption">
                                    <a href="/register" class="btn btn-danger"> Sign Up Now </a>
                                </div>
                            </div>
                            <!--/.Slides-->
                            <!--Controls-->
                            <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            <!--/.Controls-->
                        </div>
                        <!--/.Carousel Wrapper-->
                    </div>

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center">
                        <br>
                        <h3> HOW TO USE </h3>
                        <div class="row">
                            <div  class="col-md-4">
                                <span class="fa fa-user-plus text-danger"></span><br><br>
                                <h3> Register </h3>
                                <p> create a new Go-SMS account </p>
                                <a class="btn btn-primary btn-sm"> more </a>
                            </div>
                            <div  class="col-md-4">
                                <span class="fa fa-user-plus text-danger"></span><br><br>
                                <h3> Send SMS/EMAIL </h3>
                                <p> Inform clients about promotions, discounts, special offers or send other important information.  </p>
                                <a class="btn btn-primary btn-sm"> more </a>
                            </div>
                            <div  class="col-md-4">
                                <span class="fa fa-user-plus text-danger"></span><br><br>
                                <h3> Pricing </h3>
                                <p> Low prices for SMS messages and fast response, strengthen brand awareness and communicate important information </p>
                                <a class="btn btn-primary btn-sm"> more </a>
                            </div>
                        </div>
                   </div>
                </div>
                    <!-- Card content -->
    </section>
    <style>
        #benifits{
            background-image: url("{{ asset("img/bg_bulksms.jpg") }}");
        }
    </style>
    <div class="container-fluid text-white text-center" id="benifits">
        <div class="container"><br><br>
            <div class="row">
                <h3 style="margin: 8px 10%">World-class messaging that’s innovative and affordable</h3><br>
                <div class="col-md-6"><br>
                    <h4>Cost effective </h4><br>
                    The technology of SMS opens a budget-conscious channel
                    between your business and mobile users all across the world, and
                    enables you to cut costs and scale faster.
                </div>
                <div class="col-md-6"><br>
                    <h4>Freedom & Control </h4><br>
                    GO-SMS Platform gives you the freedom and control to
                    build your conversation platform your way, without downloading
                    a single app. SMS-enable any application, website or system with
                    our easy one-step integration process.

                </div>
            </div>
            <br><br>
        </div>
    </div>
    <br>
    <footer class="page-footer font-small mdb-color pt-4 text-white">

        <!-- Footer Links -->
        <div class="container text-center text-md-left">

            <!-- Footer links -->
            <div class="row text-center text-md-left mt-3 pb-3">

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold"> Go-Groups. Ltd </h6>
                    <p  style="color:white;">Go-Groups Ltd is one of the leading Software Companies in Silicon Mountain, Buea Cameroon.
                        She was founded in 2012 and registered in 2014 with their head office in Buea.</p>
                </div>
                <!-- Grid column -->

                <hr class="w-100 clearfix d-md-none">

                <!-- Grid column -->
                <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-4">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Products</h6>
                    <p>
                        <a href="">School management software</a>
                    </p>
                    <p>
                        <a href=""> Mobile app development </a>
                    </p>
                    <p>
                        <a href="">Database implementation</a>
                    </p>
                    <p>
                        <a href="">Web app development</a>
                    </p>
                </div>
                <!-- Grid column -->

                <hr class="w-100 clearfix d-md-none">

                <!-- Grid column -->
                <hr class="w-100 clearfix d-md-none">

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3" style="color:white;">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                    <p style="color:white;">
                        <i class="fa fa-home mr-3"></i> Buea, SouthWest Region , Cameroon</p>
                    <p style="color:white;">
                        <i class="fa fa-phone mr-3"></i> (+237) 233 322 077 </p>
                    <p style="color:white;">
                        <i class="fa fa-whatsapp mr-3"></i> (+237) 656 686 016</p>
                </div>
                <!-- Grid column -->

            </div>
            <!-- Footer links -->

            <hr>

            <!-- Grid row -->
            <div class="row d-flex align-items-center">

                <!-- Grid column -->
                <div class="col-md-7 col-lg-8">

                    <!--Copyright-->
                    <p class="text-center text-md-left">© 2018 Copyright:
                        <a href="http://www.go-groups.net/">
                            <strong> Go-GROUP.LTD </strong>
                        </a>
                    </p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-5 col-lg-4 ml-lg-0">

                    <!-- Social buttons -->
                    <div class="text-center text-md-right">
                        <ul class="list-unstyled list-inline">
                            <li class="list-inline-item">
                                <a class="btn-floating btn-sm btn-primary mx-1">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn-floating btn-sm btn-info mx-1">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn-floating btn-sm btn-danger mx-1">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn-floating btn-sm btn-success mx-1">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->

    </footer>
    <!-- Footer -->
@endsection
