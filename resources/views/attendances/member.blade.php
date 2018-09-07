@extends('layouts.app')
@section('title',"Personal Attendance")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Personal Attendance</li>
                        </ol>
                    </nav>
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text"></p>
                        <table class="display nowrap" id="eventsTableData">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Reference</th>
                                <th>Event</th>
                                <th>Character</th>
                                <th>Pot</th>
                                <th>Cut</th>
                                <th>Leader Cut</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attendances_user as $attendance)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($attendance->run_at)->format('d M Y H:i') }}</td>
                                    <td>{{$attendance->reference}}</td>
                                    <td>{{$attendance->description}}</td>
                                    <td>{{$attendance->name}}-{{$attendance->realm}}</td>
                                    <td>@money($attendance->pot,"WOW")</td>
                                    <td>@money($attendance->cut,"WOW")</td>
                                    <td>@money($attendance->leader_cut,"WOW")</td>
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
    </div>
@endsection
@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD MMM YYYY HH:mm');

            $('#eventsTableData').DataTable({
                order: [ 0, 'desc' ],
            });
        } );

        window.setTimeout(function() {
            $("#alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 5000);
    </script>
@stop