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
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('teamsignups.store')}}" method="post">
                            {{csrf_field()}}
                            {{method_field('POST')}}
                            <table class="" id="teamsDataTable">
                                <thead class="">
                                <th>Team ID</th>
                                <th>Team Name</th>
                                <th>Event</th>
                                <th>Date Time</th>
                                <th>Character</th>
                                <th>Role</th>
                                </thead>
                                <tbody>
                                <p></p>
                                @foreach($teams as $team)
                                    <tr>
                                        <input type="hidden" name="team[{{$team->id}}]" value="{{$team->id}}">
                                        <td>{{ $team->id }}</td>
                                        <td>{{ $team->name }}</td>
                                        <td>{{ $team->article->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($team->created_at)->format('d M Y H:i') }}</td>
                                        <td>
                                            <div class="col">
                                                <select name="character[{{$team->id}}]" id="" class="form-control form-control-sm" >
                                                    <option value="0" selected>Decline</option>
                                                    @foreach($characters2 as $character2)
                                                        <option value="{{$character2->id}}">{{$character2->name}}-{{$character2->realm}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col">
                                                <select name="part[{{$team->id}}]" id="" class="form-control form-control-sm" >
                                                    <option value="0" selected>None</option>
                                                    @foreach($parts as $part)
                                                        <option value="{{$part->name}}">{{$part->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td><td></td><td></td><td></td>
                                    <td>

                                        <button role="submit" name="submit" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Signup</button>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
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