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
        @component('components.accountant')
        @endcomponent
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 border bg-primary text-white">
                <h5 class="mt-2">Bank of {{$transactions[0]->bank->name}} ({{$transactions[0]->bank->faction}})
                </h5>
            </div>
            <div class="col-1"></div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <table class="" id="transactionsDataTable">
                    <thead class="">
                    <th>ID</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Amount IN</th>
                    <th>Amount OUT</th>
                    <th>Recipient</th>
                    <th>DateTime</th>

                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ substr($transaction->operation, 1, 3) }}</td>
                            <td>{{ substr($transaction->operation, 6) }}</td>
                            @if(($transaction->amount) > 0)
                                <td>@money($transaction->amount, 'WOW')</td>
                                <td></td>
                            @else
                                <td></td>
                                <td>@money($transaction->amount, 'WOW')</td>
                            @endif
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y H:i') }}</td>

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
            $.fn.dataTable.moment('DD MMM YYYY HH:mm');

            $('#transactionsDataTable').DataTable({
                order: [ 6, 'desc' ],
                "LengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
                "pageLength": 25
            });
        } );
    </script>
@stop