@extends('layouts.app')
@section('title',"Oblivion Events")
@section('content')
    <div class="container-fluid">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Events</li>
                </ol>
            </nav>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <div class="table-responsive">
                    <table class="display nowrap" id="eventsTableData">
                        <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Event</th>
                            <th>Scheduled</th>
                            <th>Planner</th>
                            <th>Bookings / Total</th>
                            <th>Signups / Total</th>
                            <th>Overbooking</th>
                            @hasrole(config('globals.teamleaders'))
                                <th>Pot</th>
                                <th>Leader Cut</th>
                            @endhasrole
                            <th>Raid Status</th>

                            <th>
                                @hasrole(config('globals.managers'))
                                Actions
                                @endhasrole
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($events_all as $event)
                            <tr>
                                <td><a href="{{ route('events.show', $event->id) }}">{{ $event->reference }}</a></td>
                                <td>{{ $event->article->description }}</td>
                                <td>{{ ($event->run_at)? \Carbon\Carbon::parse($event->run_at)->format('d M Y H:i') : "" }}</td>
                                <td>{{ $event->user->name}}</td>
                                <td>
                                    @hasrole(config('globals.managers'))
                                        <a href="{{ route('bookings.create')}}?id={{$event->id}}&ref={{$event->reference}}" >
                                            <i class="fas fa-book fa-lg"></i></a>
                                    @endhasrole
                                    @if($event->buyers_booked > $event->buyers)
                                        <font color="red">{{$event->buyers_booked}}</font> / {{ $event->buyers }}
                                    @else
                                        {{ ($event->buyers_booked)? ($event->buyers_booked) : 0 }} / {{ $event->buyers }}
                                    @endif
                                    @hasrole(config('globals.managers'))
                                    <a href="{{ route('bookings.show', $event->id)}}"><i class="fas fa-list-ol fa-lg"></i></a>
                                    @endhasrole
                                </td>
                                <td>
                                    @hasrole(config('globals.members'))
                                        @if(Cookie::get(Auth::user()->id.'/CookieEvent/'.$event->id))
                                            {{ ($event->boosters_booked)? ($event->boosters_booked) : 0 }}
                                                / {{ $event->boosters }}
                                            @if($event->status == "Open")
                                                <a href="{{ route('signups.cancel',$event->id)}}">
                                                    <i class="fas fa-times fa-lg"></i></a>
                                            @endif
                                        @else
                                            @if($event->status == "Open")
                                                <a href="{{ route('signups.sign', $event->id) }}">
                                                    <i class="fas fa-plus fa-lg"></i></a>
                                            @endif
                                            {{ ($event->boosters_booked)? ($event->boosters_booked) : 0 }}
                                                / {{ $event->boosters }}
                                        @endif
                                    @endhasrole
                                </td>
                                <td>{{ ($event->overbooking)? "Yes" : "No" }}</td>
                                @hasrole(config('globals.teamleaders'))
                                <td>@money($event->pot,"WOW")</td>
                                <td>@money($event->leader_cut,"WOW")</td>
                                @endhasrole
                                <td>{{ $event->status }}</td>
                                <td>
                                    @hasrole(config('globals.managers'))
                                        <a href="{{ route('events.edit', $event->id) }}" ><i class="fas fa-edit fa-lg"></i></a>
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
            $.fn.dataTable.moment('DD-MM-YYYY HH:mm');

            $('#eventsTableData').DataTable({
                order: [ 2, 'desc' ],
                });
        } );

        window.setTimeout(function() {
            $("#alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 5000);
    </script>
@stop