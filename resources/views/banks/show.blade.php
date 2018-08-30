@extends('layouts.app')
@section('title',"Banks Management")
<?php
use Akaunting\Money\Currency;
use Akaunting\Money\Money;
?>
@section('css')
    <link href="{{ url('/css/banks.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 border bg-primary text-white"><h5 class="mt-2">Oblivion Banks Management</h5></div>
            <div class="col-1"></div>
            <div class="col-1"></div>
            <div class="col-10">
                <table class="" id="transactionsDataTable">
                    <thead class="">
                    <th>ID</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Recipient</th>
                    <th>DateTime</th>
                    <th>Operator</th>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ substr($transaction->operation, 1, 3) }}</td>
                            <td>{{ substr($transaction->operation, 6) }}</td>
                            <td>@money($transaction->amount, 'WOW')</td>
                            <td>{{ $transaction->username }}</td>
                            <?php $dateTemp = DateTime::createFromFormat('Y-m-d H:i:s', $transaction->created_at);
                            $dateTemp = $dateTemp->format('d-m-Y H:i');
                            ?>
                            <td>{{ $dateTemp }}</td>
                            <td>{{ $transaction->operator }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
@stop
@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD-MM-YYYY HH:mm');

            $('#transactionsDataTable').DataTable({
                order: [ 5, 'desc' ],
            });
        } );
    </script>
@stop