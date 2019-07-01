@extends('layouts.app')

@section('content')
    <div class="container">
        <card>
            <h3 class="text-center"> transactions </h3>
            @if ($transactions->count() > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr class="text-center">
                        <th scope="col"> No. </th>
                        <th scope="col"> message_id </th>
                        <th scope="col"> number of recipients </th>
                        <th>amount </th>
                        <th>channel</th>
                        <th> mobile account </th>
                        <th scope="col"> Transaction ID </th>
                        <th> Sent_at </th>
                        <th> months </th>
                        <th> action </th>
                    </tr>
                    </thead>
                    <?php $count = 1; ?>
                    <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $count ++ }}</td>
                            <td>{{ $transaction->message_id }}</td>
                            <td>{{ $transaction->recipients }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->channel }}</td>
                            <td>{{ $transaction->mobile_account }}</td>
                            <td>{{ $transaction->transaction_id }} </td>
                            <td>{{ $transaction->created_at }} </td>
                            <td>{{ $transaction->created_at->format('d') }}</td>
                            <td>
                                    <a href="/receipt/{{ $transaction->id }}" class="btn btn-info btn-sm"> download </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h5 class="text-center"> No transaction done </h5>
            @endif

        </card>
    </div>
@endsection
