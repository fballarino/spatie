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
<!-- todo: layout for bank-->
<div class="container">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-8 border bg-primary text-white"><h5 class="mt-2">Oblivion Banks Management</h5></div>
        <div class="col-3"></div>
        <div class="col-1"></div>
        <div class="col-8">
            <table class="table table-hover">
                <thead class="">
                    <th>Region</th>
                    <th>Realm</th>
                    <th>Faction</th>
                    <th>Current Balance</th>
                    <th>Ops</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($banks as $bank)
                        <tr>
                            <td>{{$bank->region}}</td>
                            <td>{{$bank->name}}</td>
                            <td>{{$bank->faction}}</td>
                            <td>@money($bank->balance, 'WOW')</td>
                            <td>
                                @hasrole(config('globals.accountants'))
                                    <a href="{{route('transactions.add', $bank->id)}}">
                                        <i class="fas fa-plus-circle fa-lg"></i></a>
                                    <a href="{{route('transactions.sub', $bank->id)}}">
                                        <i class="fas fa-minus-circle fa-lg"></i></a>
                                @endhasrole
                            </td>
                            <td>
                                <a href="{{route('banks.show', $bank->id)}}"><i class="fas fa-info-circle fa-lg"></i></a>
                                @hasrole(config('globals.executives')) / <i class="fas fa-marker fa-lg"></i>@endhasrole
                                @hasrole(config('globals.managers')) / <i class="fas fa-trash fa-lg"></i>@endhasrole
                            </td>
                        </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total Balance:</td>
                        <td>@money($totalBalance, 'WOW')</td>
                        <td></td>

                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-3"></div>
    </div>
</div>
@stop
@section('javascript')
    @parent

@stop