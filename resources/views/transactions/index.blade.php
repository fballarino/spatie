@extends('layouts.app')
@section('title',"Banks Management")
<?php
use Akaunting\Money\Currency;
use Akaunting\Money\Money;
//dd($transactions);
?>
@section('css')
    <link href="{{ url('/css/banks.css') }}" rel="stylesheet">
@stop
@section('content')
    <div class="container-fluid">
        @component('components.accountant')
        @endcomponent
        <div class="row">
            <div class="col-1"></div>
            <div class="col-12 border bg-primary text-white">
                <h5 class="mt-2">@if(!empty($transactions[0]))Movements for Bank of {{$transactions[0]->bank->name}} ({{$transactions[0]->bank->faction}})@endif
                </h5>
            </div>
            <div class="col-1"></div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{route('transactions.verify')}}" method="post">
                {{ csrf_field() }}
                <table class="" id="transactionsDataTable">
                    <thead class="">
                    <th>ID</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Amount IN</th>
                    <th>Amount OUT</th>
                    <th>Recipient</th>
                    <th>Issuer</th>
                    <th>DateTime</th>
                    <th>Verified</th>
                    <th>Operations</th>
                    </thead>
                    <tbody>
                    <p></p>
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
                            <td>{{ $transaction->recipient->name }}</td>
                            <td>{{ $transaction->sender->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y H:i') }}</td>
                            <td>
                                <input type="checkbox" name="{{$transaction->id}}"
                                        {{($transaction->verified)? "disabled checked" : ""}}>
                                {{$transaction->verified_by}}
                            </td>
                            <td>
                                @hasrole(config('globals.accountants'))
                                    <a href="{{ route('transactions.show', $transaction->id) }}"><i class="far fa-arrow-alt-circle-right fa-lg"></i></a>
                                    <a href="{{ route('transactions.edit', $transaction->id) }}"><i class="far fa-edit fa-lg"></i></a>
                                @endhasrole
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            <td>
                                @hasrole(config('globals.accountants'))
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-check-square"></i> Verify</button>
                                @endhasrole
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                </form>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD MMM YYYY HH:mm');

            $('#transactionsDataTable').DataTable({
                order: [ 7, 'desc' ],
                "LengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
                "pageLength": 25
            });
        } );
    </script>
@stop