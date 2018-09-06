@extends('layouts.app')
@section('title', "Oblivion Dashboard")
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-3">
                <div class="card border-light mb-3">
                    <div class="card-header">
                        <i class="fas fa-user-friends fa-2x"></i>
                        <a href="{{route('characters.index')}}" class="card-link">Characters</a>
                    </div>
                    <div class="card-body text-dark">
                        <h7 class="card-title"></h7>
                        <ul class="list-group list-group-flush">
                        <p class="card-text">
                            @foreach($characters as $character)
                                <li class="list-group-item">
                                    {{$character->name}}-{{$character->realm}}
                                    ({{$character->gear}}) {{$character->class}}
                                </li>
                            @endforeach
                        </p>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card border-light mb-3">
                    <div class="card-header">
                        <i class="far fa-file-alt fa-2x"></i>
                        <a href="#" class="card-link">Signups</a>
                    </div>
                    <div class="card-body text-dark">
                        <h7 class="card-title"></h7>
                        <p class="card-text">
                        <ul class="list-group list-group-flush">
                            @foreach($signups as $signup)
                                <li class="list-group-item">
                                    {{$signup->event->product_name}}-{{$signup->event->difficulty}}  /
                                    {{\Carbon\Carbon::parse($signup->event->run_at)->format('d M Y H:i')}}
                                </li>
                            @endforeach
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card border-light mb-3">
                    <div class="card-header">
                        <i class="fas fa-sitemap fa-2x"></i>
                        <a href="#" class="card-link">Attendances</a>
                    </div>
                    <div class="card-body text-dark">
                        <h6 class="card-title"></h6>
                        <p class="card-text">
                        <ul class="list-group list-group-flush">
                            @foreach($attendances as $attendance)
                                <li class="list-group-item">
                                    {{$attendance->event->product_name}} /
                                    {{\Carbon\Carbon::parse($attendance->event->run_at)->format('d M Y H:i')}}
                                    Cut: @money(($attendance->cut + $attendance->leader_cut),"WOW")
                                </li>
                            @endforeach
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-1"></div>
        <!-- / row 1-->
        <div class="row">
            <div class="col-1"></div>
            <div class="col-3">
                <div class="card border-light mb-3">
                    <div class="card-header">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                        <a href="#" class="card-link">Balance</a>
                    </div>
                    <div class="card-body text-dark">
                        <h6 class="card-title"></h6>
                        <p class="card-text">Amount due: @money($balance,"WOW")</p>
                        @hasrole(config('globals.advertisers'))
                        <p class="card-text">Fees collected: @money($fees,"WOW")</p>
                        @endhasrole
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card border-light mb-3">
                    <div class="card-header">
                        <i class="fas fa-piggy-bank fa-2x"></i>
                        <a href="#" class="card-link">Teams</a></div>
                    <div class="card-body">
                        <h6 class="card-title"></h6>
                        <ul class="list-group list-group-flush">
                            @foreach($characters_array as $single_character)
                                @foreach($single_character->teams as $team)
                                <li class="list-group-item">
                                    <a href="{{ route('teams.show',$team->id) }}" class="card-link">
                                        {{$single_character->name}}-{{$single_character->realm}} /
                                        {{$team->name}}</a></li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @hasrole(config('globals.accountants'))
            <div class="col-4">
                <div class="card border-light mb-3">
                    <div class="card-header">
                        <i class="fas fa-piggy-bank fa-2x"></i>
                        <a href="{{ route('banks.index') }}" class="card-link">Banks & Payments</a></div>
                    <div class="card-body">
                        <h6 class="card-title">Economy Management</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="{{ route('goldtracks.index') }}" class="card-link">Goldtrack</a></li>
                            <li class="list-group-item">
                                <a href="{{ route('transactions.index') }}" class="card-link">Transactions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endhasrole
            <div class="col-1"></div>
        </div>
    </div>
@stop
@section('javascript')
    @parent
@stop