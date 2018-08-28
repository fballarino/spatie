@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h3>
                <i class="fas fa-calendar-alt"></i>
                <a href="{{ route('dashboard.index') }}">Dashboard </a>/ Events</h3>
            <hr>
        </div>
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
                <th>temp</th>
                <th>temp</th>
                <th>Pot</th>
                <th>Status</th>
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
                        @hasrole(config('globals.managers'))
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
                    <td>0 / {{ $event->boosters }}</td>
                    <td>{{ ($event->overbooking)? "Yes" : "No" }}</td>
                    <td>temp</td>
                    <td>temp</td>
                    <td>{{ $event->pot }}</td>
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
        <br><a href="{{ route('events.create') }}" class="btn btn-success">Add Event</a></br>
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