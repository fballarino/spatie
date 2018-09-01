@extends('layouts.app')
@section('title',"Personal Balance")
<?php
use Akaunting\Money\Currency;
use Akaunting\Money\Money;
?>
@section('css')
    <link href="{{ url('/css/banks.css') }}" rel="stylesheet">
@stop
@section('content')
    <div class="container">
        @component('components.personal')
        @endcomponent
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 border bg-primary text-white">
                <h5 class="mt-2">Personal Balance
                </h5>
            </div>
            <div class="col-1"></div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <ul class="list-group">
                    @hasrole(config('globals.advertisers'))
                        <li class="list-group-item">Fee Amount Collected: @money($balance[0],"WOW")</li>
                    @endhasrole
                    @hasrole(config('globals.collectors'))
                        <li class="list-group-item">Goldtrack Amount Collected: @money($balance[1],"WOW")</li>
                        <li class="list-group-item">Goldtrack Amount Deposited: @money($balance[2],"WOW")</li>
                        <li class="list-group-item">Goldtrack Amount to Deposit: @money($balance[1]-$balance[2],"WOW")</li>
                    @endhasrole
                        <li class="list-group-item">Attendance Amount Earned: @money($balance[3],"WOW")</li>
                        <li class="list-group-item">Amount received by Oblivion: @money($balance[4],"WOW")</li>
                        <li class="list-group-item">Amount Due:@money($balance[3]-$balance[4],"WOW")</li>
                </ul>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
@stop
@section('javascript')
    @parent

@stop