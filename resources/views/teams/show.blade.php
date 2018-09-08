@extends('layouts.app')
@section('title',"Team Information")
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
                                <li class="breadcrumb-item"><a href="{{route('teams.index')}}">Teams</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$team_data->name}}
                            </ol>
                        </nav>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text"></p>
                        <div class="row">
                            <div class="col-12">
                                <table class="" id="teamDataTable">
                                    <thead class="">
                                    <th>Signed on</th>
                                    <th>Character</th>
                                    <th>Wowprogress</th>
                                    <th>Spec & Class</th>
                                    <th>Role Selected</th>
                                    </thead>
                                    <tbody>
                                    <p></p>
                                    @foreach($team_data->characters as $character)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($character->pivot->created_at)
                                                ->format('d M Y H:i') }}</td>
                                            <td>{{ $character->name }}-{{ $character->realm }}</td>
                                            <td><a href="{{ $character->wowprogress }}">Link</a></td>
                                            <td>({{ $character->gear }}) {{ $character->mainspec }} {{ $character->class }}</td>
                                            <td>{{ $character->pivot->part }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
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
    </div>
@stop
@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD MMM YYYY HH:mm');

            $('#teamDataTable').DataTable({
                order: [ 1, 'desc' ],
                "LengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
                "pageLength": 25
            });
        } );
    </script>
@stop