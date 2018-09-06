@extends('layouts.app')
@section('title',"Teams Management")
@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="card">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Teams</li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <div class="row">
                    <div class="col-12">
                            <table class="" id="teamsDataTable">
                                <thead class="">
                                <th>Team ID</th>
                                <th>Team Name</th>
                                <th>Event</th>
                                <th>Tanks</th>
                                <th>Healers</th>
                                <th>Melees</th>
                                <th>Ranged</th>
                                <th>Created</th>
                                <th>Operations</th>
                                </thead>
                                <tbody>
                                <p></p>
                                @foreach($teams as $team)
                                    <tr>
                                        <td>{{ $team->id }}</td>
                                        <td>{{ $team->name }}</td>
                                        <td>{{ $team->article->description }}</td>
                                        <td>{{ $team->tank }} </td>
                                        <td>{{ $team->healer }}</td>
                                        <td>{{ $team->mdps }}</td>
                                        <td>{{ $team->rdps }}</td>
                                        <td>{{ \Carbon\Carbon::parse($team->created_at)->format('d M Y H:i') }}</td>
                                        <td>
                                            @hasrole(config('globals.collectors'))
                                                <a href="{{route('teams.show', $team->id)}}">
                                                <i class="far fa-eye fa-lg"></i></a>
                                                <a href="{{route('teams.edit', $team->id)}}">
                                                <i class="far fa-edit fa-lg"></i></a>
                                            @endhasrole
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td>

                                    </td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
                    </div>
                </div>
                @hasrole(config('globals.executives'))
                <a href="{{ route('teams.create') }}" class="btn btn-success">Add Team</a>
                @endhasrole
            </div>
            <div class="card-footer text-muted">
                {{ \Illuminate\Support\Facades\Auth::user()->name }}
            </div>
        </div>
    </div>
    <div class="col-1"></div>
    </div>
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