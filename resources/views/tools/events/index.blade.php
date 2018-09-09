@extends('layouts.app')
@section('title',"Oblivion Events")
@section('content')
    <div class="container-fluid">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tools > Events</li>
                </ol>
            </nav>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <div class="table-responsive">
                    <table class="display nowrap" id="eventsTableData">
                        <thead>
                        <tr>
                            <th>Event ID</th>
                            <th>Faction</th>
                            <th>Reference</th>
                            <th>Event</th>
                            <th>Scheduled</th>
                            <th>Planner</th>
                            <th>Bookings / Total</th>
                            <th>Signups / Total</th>
                            <th>Overbooking</th>
                            <th>Pot</th>
                            <th>Leader Cut</th>
                            <th>Raid Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($events_all as $event)
                                <tr>
                                    <td>{{$event->id}}</td>
                                    <td>({{$event->faction->faction}})</td>
                                    <td><a href="{{ route('events.show', $event->id) }}">{{$event->reference}}</a></td>
                                    <td>{{$event->article->description}}</td>
                                    <td>{{\Carbon\Carbon::parse($event->run_at)->format('d M Y H:i')}}</td>
                                    <td>{{$event->user->name}}</td>
                                    <td>{{$event->buyers_booked}}/{{$event->buyers}}</td>
                                    <td>{{$event->boosters_booked}}/{{$event->boosters}}</td>
                                    <td>{{$event->overbooking}}</td>
                                    <td>@money($event->pot,"WOW")</td>
                                    <td>@money($event->leader_cut,"WOW")</td>
                                    <td>{{$event->status}}</td>
                                    <td>
                                        @hasrole(config('globals.managers'))
                                        <a href="{{ route('events.edit', $event->id) }}" >
                                            <i class="fas fa-edit fa-lg"></i></a>
                                        @endhasrole

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @hasrole(config('globals.executives'))
                <a href="{{ route('events.create') }}" class="btn btn-success">Add Event</a>
                @endhasrole
            </div>
            <div class="card-footer text-muted">
                {{ \Illuminate\Support\Facades\Auth::user()->name }}
            </div>
        </div>

    </div>
@endsection
@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD MMM YYYY HH:mm');

            $('#eventsTableData').DataTable({
                order: [ 4, 'desc' ],
            });
        } );
    </script>
@stop