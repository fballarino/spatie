@extends('layouts.app')
@section('title',"Banks Management")

@section('content')

<div class="container">
    <div class="card">
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Banks</li>
                </ol>
        </nav>
        <div class="card-body">
            <h5 class="card-title">Displaying all Banks</h5>
            <p class="card-text"></p>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-8">
                    <table class="table table-hover">
                        <thead class="">
                        <th>Region</th>
                        <th>Realm</th>
                        <th>Faction</th>
                        <th>Current Balance</th>
                        <th>Operation</th>
                        <th>Actions</th>
                        </thead>
                        <tbody>
                        @foreach($banks as $bank)
                            <tr>
                                <td>{{$bank->region}}</td>
                                <td>{{$bank->name}}</td>
                                <td>{{$bank->faction}}</td>
                                <td>@money($bank->transactions->sum('amount'), 'WOW')</td>
                                <td>
                                    @hasrole(config('globals.accountants'))
                                    <a href="{{ route('transactions.add', $bank->id) }}">
                                        <i class="fas fa-plus-circle fa-lg"></i></a>
                                    @endhasrole
                                </td>
                                <td>
                                    <a href="{{ route('transactions.bank', $bank->id )}}"><i class="fas fa-info-circle fa-lg"></i></a>
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
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-3">

                </div>
            </div>
            <a href="{{ route('banks.create') }}" class="btn btn-success">Add Bank</a></br>
        </div>
        <div class="card-footer text-muted">
            {{ \Illuminate\Support\Facades\Auth::user()->name }}
        </div>
    </div>

</div>
@stop
@section('javascript')
    @parent

@stop