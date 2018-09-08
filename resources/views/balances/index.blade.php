@extends('layouts.app')
@section('title',"Personal Balance")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="card">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Personal Balance</li>
                        </ol>
                    </nav>
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <ul class="list-group">
                            @hasrole(config('globals.advertisers'))
                                <a href="{{route('balances.advertiser')}}" class="list-group-item list-group-item-action list-group-item-secondary">
                                    Advertisers</a>
                                <li class="list-group-item">Fees collected: @money($balance[0],"WOW")</li>
                            @endhasrole
                            @hasrole(config('globals.collectors'))
                                <li class="list-group-item list-group-item-info">Gold Collectors</li>
                                <li class="list-group-item">Amount collected: @money($balance[1],"WOW")</li>
                                <li class="list-group-item">Amount deposited: @money($balance[2],"WOW")</li>
                                <li class="list-group-item">Amount due: @money($balance[1]-$balance[2],"WOW")</li>
                            @endhasrole
                                <li class="list-group-item list-group-item-primary">Members</li>
                                <li class="list-group-item">Amount earned through attendance: @money($balance[3],"WOW")</li>
                                <li class="list-group-item">Amount received by Oblivion Community: @money($balance[4],"WOW")</li>
                                <li class="list-group-item">Balance:@money($balance[3]-$balance[4],"WOW")</li>
                        </ul>
                    </div>
                <div class="card-footer text-muted">
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
@stop
@section('javascript')
    @parent

@stop