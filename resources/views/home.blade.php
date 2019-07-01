@extends('layouts.app')

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <a href="/contacts" type="button" class="btn btn-success" style="width: 100%;"><i class="fa fa-book" style="font-size: 35px"></i> <br> Contacts <br> {{ auth::user()->contacts()->get()->count() }} </a>
            </div>
            <div class="col-md-3">
                <a href="/groups" type="button" class="btn btn-warning" style="width: 100%;"><i class="fa fa-users" style="font-size: 35px"></i> <br> Groups <br> {{ auth::user()->groups()->get()->count() }} </a>
            </div>
            <div class="col-md-3">
                <a href="/sentmessages" type="button" class="btn btn-info" style="width: 100%;"><i class="fa fa-paper-plane-o" style="font-size: 35px"></i> <br> Message sent <br> {{ auth::user()->messages()->count() }} </a>
            </div>
            <div class="col-md-3">
                <a href="/inbox" type="button" class="btn btn-danger" style="width: 100%;"><i class="fa fa-book" style="font-size: 35px"></i> <br> Notifications <br> {{ auth::user()->notifications()->count() }}</a>
            </div>
        </div>

    </section>

    <div class="row">
        <div class="col-md-12">
            <canvas id="lineChart" style="height: 350px;width: 90%;"></canvas>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>
    <script>
        //line
        var ctxL = document.getElementById("lineChart").getContext('2d');
        var myLineChart = new Chart(ctxL, {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July","August","september","October","November","December"],
                datasets: [{
                    label: "number of messages",
                    data: {{ $numb }},
                    backgroundColor: [
                        'rgba(105, 0, 132, .2)',
                    ],
                    borderColor: [
                        'rgba(200, 99, 132, .7)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
    {{-- price table --}}
    <br>
    <h2> Price List </h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col"> title </th>
            <th scope="col"> min </th>
            <th scope="col"> max </th>
            <th scope="col"> Service </th>
            <th scope="col"> unit price </th>
        </tr>
        </thead>
        <tbody>
<?php $count = 1 ?>
        @foreach($tarifs as $tarif)
            <tr>
                <th>{{ $count ++ }}</th>
                <td>{{ $tarif->name }}</td>
                <td>{{ $tarif->min }}</td>
                <td>{{ $tarif->max }}</td>
                <td>{{ $tarif->service }}</td>
                <td>{{ $tarif->unit_price }} CFA</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-lg red">
            <i class="fa fa-pencil"></i>
        </a>

        <ul class="list-unstyled">
            <li><a href="/inbox" class="btn-floating red"><i class="fa fa-inbox"></i></a></li>
            <li><a href="/groups" class="btn-floating yellow darken-1"><i class="fa fa-users"></i></a></li>
            <li><a href="/transactions" class="btn-floating blue"><i class="fa fa-money"></i></a></li>
            <li><a href="/messages/create" class="btn-floating red"><i class="fa fa-pencil"></i></a></li>
        </ul>
    </div>



@endsection
