@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <p> Name: {{ Auth::user()->name }}</p><hr>
                <p> Email: {{ Auth::user()->email }} </p><hr>
                <p> telephone: {{ Auth::user()->phone }}</p><hr>
                <p> printed date: {{date('d-m-Y')}} </p><hr>
            </div>
            <div class="col-md-4">
                <center>
                    <img class="img-thumbnail" src="http://localhost:8000/img/angular.png" height="250" width="150" alt="Card image cap">
                </center>
            </div>
            <div class="col-md-4">
                <p> MicroTech LTD </p><hr>
                <p> finance Department </p><hr>
                <p> email: {{'microtech_finance@gmail.com'}}</p><hr>
                <p> telephone: 670612010</p><hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tr>
                        <td> Payment motive </td>
                        <td> Go-SMS fee </td>
                    </tr>
                    <tr>
                        <td> Amount </td>
                        <td> {{ $transaction->amount }} CFA </td>
                    </tr>
                    <tr>
                        <td> number of message </td>
                        <td> {{$transaction->recipients}} </td>
                    </tr>
                    <tr>
                        <td> From </td>
                        <td> {{$transaction->mobile_account}} </td>
                    </tr>
                    <tr>
                        <td> To </td>
                        <td> {{ 'GO-SMS'}} </td>
                    </tr>
                    <tr>
                        <td> Transaction ID </td>
                        <td> {{ $transaction->transaction_id }} </td>
                    </tr>
                    <tr>
                        <td> Payment date </td>
                        <td> {{ $transaction->created_at }} </td>
                    </tr>
                    <tr>
                        <td> Payment channel </td>
                        <td> {{ $transaction->channel }} </td>
                    </tr>
                </table>
            </div>
        </div>
        <center>
            <a href="/download_receipt/{{ $transaction->id }}" class="btn btn-primary btn-sm"> Download </a>
        </center>
    </div>
@endsection
