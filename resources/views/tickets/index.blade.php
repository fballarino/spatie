@extends('layouts.app')
@section('title',"Tickets Management")
@section('content')
    <div class="container-fluid">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tickets</li>
                </ol>
            </nav>
            <div class="card-body">
                <h5 class="card-title">Displaying Tickets</h5>
                <p class="card-text"></p>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <table class="table table-hover">
                            <thead>
                            <th>Number</th>
                            <th>Issuer</th>
                            <th>Event</th>
                            <th>Title</th>
                            <th>Text</th>
                            <th>Actions</th>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{$ticket->code}}</td>
                                    <td>{{$ticket->attendance->user->name}}</td>
                                    <td>{{$ticket->attendance->event->reference}}</td>
                                    <td>{{(strlen($ticket->title) > 30 ? substr($ticket->title,0,30)." ..." : $ticket->title)}}</td>
                                    <td>{{(strlen($ticket->description) > 40 ? substr($ticket->description,0,40)." ..." : $ticket->description)}}</td>
                                    <td>Actions</td>
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
                    <div class="col-1"></div>
                </div>
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