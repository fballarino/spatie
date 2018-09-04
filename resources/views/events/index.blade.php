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
                            <th>Difficulty</th>
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
                        @foreach ($allEvents as $event)
                            <tr>
                                <td>
                                    @hasrole(config('globals.members'))
                                    <a href="{{ route('events.show', $event->id) }}">{{ $event->reference }}</a>
                                    @else
                                        {{ $event->reference }}
                                        @endhasrole
                                </td>
                                <td>{{ $event->product_name }}</td>
                                <td>{{ $event->difficulty }}</td>
                                <?php $dateTemp = DateTime::createFromFormat('Y-m-d H:i:s', $event->run_at);
                                $dateTemp = $dateTemp->format('d M Y H:i');
                                ?>
                                <td>{{ ($event->run_at)? $dateTemp : "" }}</td>
                                <td>
                                    @foreach($allUsers as $user)
                                        {{ ($user->id == $event->user_id)? $user->name : "" }}
                                    @endforeach
                                </td>
                                <td>
                                    @hasrole(config('globals.managers'))
                                    <a href="{{ route('bookings.create')}}?id={{$event->id}}&ref={{$event->reference}}" ><i class="fas fa-book fa-lg"></i></a>
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
                                <!-- todo logic for signups-->
                                <td>
                                    @if(Cookie::get(Auth::user()->id.'/CookieEvent/'.$event->id))
                                        @hasrole(config('globals.members'))
                                        {{ Form::open(['method' => 'DELETE', 'class' =>'form-inline', 'route' => ['signups.destroy', $event->id] ])}}
                                        {{ ($event->boosters_booked)? ($event->boosters_booked) : 0 }} / {{ $event->boosters }}
                                        <div class="form-group">
                                            <div class="input-bar-item">
                                                <button class="btn btn-light"><i class="fas fa-times fa-lg"></i></button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                        @endhasrole
                                    @else
                                        @hasrole(config('globals.members'))
                                        <a href="{{ route('signups.sign', $event->id) }}"><i class="fas fa-plus fa-lg"></i></a>
                                        &nbsp;&nbsp;      {{ ($event->boosters_booked)? ($event->boosters_booked) : 0 }} / {{ $event->boosters }}
                                        @endhasrole
                                    @endif
                                </td>
                                <td>{{ ($event->overbooking)? "Yes" : "No" }}</td>
                                @hasrole(config('globals.teamleaders'))
                                <td>@money($event->pot,"WOW")</td>
                                <td>@money($event->leader_cut,"WOW")</td>
                                @endhasrole
                                <td>{{ $event->status }}</td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'class' =>'form-inline', 'route' => ['events.destroy', $event->id] ]) !!}
                                    @hasrole(config('globals.managers'))
                                    <div class="form-group">
                                        <a href="{{ route('events.edit', $event->id) }}" ><i class="fas fa-edit fa-lg"></i></a>
                                    </div>
                                    @endhasrole
                                    @hasrole(config('globals.executives'))
                                    <div class="form-group">
                                        <div class="input-bar-item">
                                            <button class="btn btn-light"><i class="fas fa-trash fa-lg"></i></button>
                                        </div>
                                    </div>
                                    @endhasrole
                                    {!! Form::close() !!}
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
                order: [ 3, 'desc' ],
                });
        } );

        window.setTimeout(function() {
            $("#alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 5000);
    </script>
@stop