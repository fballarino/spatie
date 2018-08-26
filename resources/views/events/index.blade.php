@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h3>
                <i class="fas fa-calendar-alt"></i>
                <a href="{{ route('dashboard.index') }}">Dashboard </a>/ Events
                <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
                <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h3>
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
                <th>Buyers Slots</th>
                <th>Spots</th>
                <th>Overbooking</th>
                <th>Buyers Booked</th>
                <th>Backup</th>
                <th>Pot</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($allEvents as $event)
                <tr>
                    <td><a href="{{ route('events.show', $event->id) }}">{{ $event->reference }}</a></td>
                    <td>{{ $event->product_name }}</td>
                    <td>{{ $event->difficulty }}</td>
                    <?php $dateTemp = DateTime::createFromFormat('Y-m-d H:i:s', $event->run_at);
                    $dateTemp = $dateTemp->format('d-m-Y H:i');
                    ?>
                    <td>{{ ($event->run_at)? $dateTemp : "" }}</td>
                    <td>Someone</td>
                    <td>{{ $event->buyers }}</td>
                    <td>{{ $event->boosters }}</td>
                    <td>{{ ($event->overbooking)? "Yes" : "No" }}</td>
                    <td>12</td>
                    <td>3</td>
                    <td>1.200.000</td>
                    <td>Closed</td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'class' =>'form-inline', 'route' => ['events.destroy', $event->id] ]) !!}
                        <div class="form-group">
                            <a href="{{ route('events.edit', $event->id) }}" ><i class="fas fa-edit fa-lg"></i></a>
                        </div>
                        <div class="form-group">
                            <div class="input-bar-item">
                                <button class="btn btn-light"><i class="fas fa-trash fa-lg"></i></button>
                            </div>
                        </div>
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
        $(document).ready( function () {
            $('#eventsTableData').DataTable({
                order: [ 3, 'desc' ],
            });
        } );
    </script>
@stop