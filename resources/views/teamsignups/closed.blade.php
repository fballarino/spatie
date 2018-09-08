@extends('layouts.app')
@section('title',"Teams Signups")
@section('content')
    <div class="container-fluid">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="card">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Teams Signups</li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Signups closed</h5>
                    <p class="card-text">
                        Team signups are currently not available, we will reorganize the teams on a future date.
                    </p>
                </div>
                <div class="card-footer text-muted">
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
@stop
@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD MMM YYYY HH:mm');

            $('#teamsDataTable').DataTable({
                order: [ 7, 'desc' ],
                "LengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
                "pageLength": 25
            });
        } );
    </script>
@stop