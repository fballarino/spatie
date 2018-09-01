@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>
                <i class="fas fa-calendar-alt"></i>
                <a href="{{ route('dashboard.index') }}">Dashboard </a>/
                <a href="{{ route('events.index') }}">Events </a> / Attendances</h3>
            <hr>
        </div>
        <div class="row">

                <table class="display nowrap" id="eventsTableData">
                    <thead>
                    <tr>
                        <th>Event ID</th>
                        <th>Event</th>
                        <th>Difficulty</th>
                        <th>Reference</th>
                        <th>Date</th>
                        <th>Boosters</th>
                        <th>Pot</th>
                        <th>Leader Cut</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>{{$attendance->id}}</td>
                                <td>{{$attendance->product_name}}</td>
                                <td>{{$attendance->difficulty}}</td>
                                <td><a href="{{ route('attendances.displaySignups', $attendance->id) }}">{{$attendance->reference}}</a></td>
                                <td>{{ \Carbon\Carbon::parse($attendance->run_at)->format('d M Y H:i') }}</td>
                                <td>{{$attendance->boosters}}</td>
                                <td>{{$attendance->pot}}</td>
                                <td>{{$attendance->leader_cut}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

        </div>
    </div>

@endsection
@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD MMM YYYY HH:mm');

            $('#eventsTableData').DataTable({
                order: [ 4, 'asc' ],
            });
        } );

        window.setTimeout(function() {
            $("#alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 5000);
    </script>
@stop