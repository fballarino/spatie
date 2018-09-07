@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="card">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Attendance Event List</li>
                        </ol>
                    </nav>
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text"></p>
                            <table class="display nowrap" id="eventsTableData">
                                <thead>
                                <tr>
                                    <th>Event ID</th>
                                    <th>Event</th>
                                    <th>Reference</th>
                                    <th>Date</th>
                                    <th>Boosters</th>
                                    <th>Pot</th>
                                    <th>Leader Cut</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attendances as $attendance)
                                    <tr>
                                        <td>{{$attendance->id}}</td>
                                        <td>{{$attendance->article->description}}</td>
                                        <td><a href="{{ route('attendances.displaySignups', $attendance->id) }}">{{$attendance->reference}}</a></td>
                                        <td>{{ \Carbon\Carbon::parse($attendance->run_at)->format('d M Y H:i') }}</td>
                                        <td>{{$attendance->boosters}}</td>
                                        <td>@money($attendance->pot,"WOW")</td>
                                        <td>@money($attendance->leader_cut,"WOW")</td>
                                        <td>
                                            @hasrole(config('globals.attendances'))
                                            <a href="{{ route('events.edit', $attendance->id) }}" ><i class="fas fa-edit fa-lg"></i></a>
                                            @endhasrole
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        {{ \Illuminate\Support\Facades\Auth::user()->name }}
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
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