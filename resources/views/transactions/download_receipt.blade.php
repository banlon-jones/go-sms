<!DOCTYPE html>

<html>

<head>

    <title>Hi</title>
    <style>
        .row{
            width: 100%;
            padding: 20px;
            margin: 5px;
        }

        .col-md-4{
            margin: 5px;
            border:none;
            float: left;
            width: auto;
        }
        .img-thumbnail {
            padding: .25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: .25rem;
        }
        table, td, th {
            border: 1px solid #ddd;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 15px;
        }

    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <p> Name: {{ $user->name }}</p>
            <p> Email: {{ $user->email }} </p>
            <p> telephone: {{ $user->phone }} </p>
            <p> printed date: {{date('d-m-Y')}} </p>
        </div>
        <div class="col-md-4" style="width: 200px;height: 200px">
            <center>
                <img src="{{ public_path() . '/img/mtn.jpg' }}" heigth="100" width="100" alt="image">
            </center>
        </div>
        <div class="col-md-4">
            <p> MicroTech LTD </p>
            <p> finance Department </p>
            <p> email: {{'microtech_finance@gmail.com'}}</p>
            <p> telephone: 670612010</p>
        </div>
    </div>
        <h4 style="margin-left: 40%"> Transaction Details </h4>
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
</div>
</body>
</html>