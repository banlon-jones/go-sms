
@extends('layouts.app')
@section('content')
    <br>
    <div class="row">
        <div class="col-md-8">
            <canvas id="lineChart" style="height: 50%;"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="pieChart" style="height: 50%;"></canvas>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header info-color text-white">
            <h2>Users summary table</h2>
        </div>
        <table class="table table-striped">
            <tr>
                <th>Total Users</th>
                <th>Privilege Users</th>
                <th>Validated Users</th>
                <th>Unverified users</th>
                <tbody>
                <tr>
                    <td class="totalUsers"> {{ $totalUsers }} </td>
                    <td class="privilege_users">{{$privilegeUsers}}</td>
                    <td class="validateUsers">{{$validateUsers}}</td>
                    <td class="unverifiedUsers">{{$unverifiedUsers}}</td>
                </tr>
                </tbody>
            </tr>
        </table>
    </div>
    <br>
    <div class="card">
        <div class="card-header  green text-white"><h1> Transactions </h1></div>
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Transaction id</th>
                <th>Date</th>
                <th>Message</th>
                <th>account ID</th>
                <th>Recipients</th>
                <th>Total Amount</th>
                <th>Channel</th>
                <?php $count=1;?>
                <tbody >
                @foreach($transactions as $tran)
                    <tr>
                        <td>{{ $count++}}</td>
                        <td>{{ $tran->users()->get() }}</td>
                        <td>{{ $tran->transaction_id }}</td>
                        <td> {{$tran->created_at}}</td>
                        <td>{{$tran->message()->get()->pluck('header')}}</td>
                        <td>{{ $tran->mobile_account}}</td>
                        <td>{{ $tran->recipients}}</td>
                        <td>{{ $tran->amount }}</td>
                        <td>{{ $tran->channel }}</td>
                    </tr>
                @endforeach
                </tbody>
        </table>
    </div>

  <script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>
  <script>
      //pie
      var ctxP = document.getElementById("pieChart").getContext('2d');
      var myPieChart = new Chart(ctxP, {
          type: 'pie',
          data: {
              labels: ["validated users", "unverified users", "privilege users",],
              datasets: [
                  {
                      data: [{{$validateUsers}}, {{$unverifiedUsers}}, {{$privilegeUsers}},],
                      backgroundColor: ["#53C128","#FF5A5E", "#FDB45C",],
                      hoverBackgroundColor: [ "#53C128","#FF5A5E", "#FFC870",]
                  }
              ]
          },
          options: {
              responsive: true
          }
      });
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
              },
                  {
                      label: "Amount",
                      data: {{ $amount }},
                      backgroundColor: [
                          'rgba(0, 137, 132, .2)',
                      ],
                      borderColor: [
                          'rgba(0, 10, 130, .7)',
                      ],
                      borderWidth: 2
                  }
              ]
          },
          options: {
              responsive: true
          }
      });
  </script>


@endsection