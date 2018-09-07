@extends('layouts.app')
@section('title', 'Display Event')
@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ ($eventData->reference) }}</li>
                </ol>
            </nav>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <div class="table-responsive">
                    <table class="display nowrap" id="signupsTableData">
                        <thead>
                        <tr>
                            <th>Character</th>
                            <th>Signed on:</th>
                            <th>Gear</th>
                            <th>Spec / Class</th>
                            <th>Wowprogress</th>
                            <th>Status</th>
                            <th>
                                @hasrole(config('globals.managers'))
                                Team Leader Choice
                                @endhasrole
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($signups as $signup)
                            <tr>
                                <td>{{ $signup->name }}-{{ $signup->realm }}</td>
                                <td>{{ \Carbon\Carbon::parse($signup->created_at)->format('d M Y H:i') }}</td>
                                <td>{{ $signup->gear }}</td>
                                <td>{{ $signup->mainspec }} / {{ $signup->class }}</td>
                                <td><a href="{{ $signup->wowprogress }}">Link</a></td>
                                <td>{{ $signup->status }}</td>
                                <td>
                                    @hasrole(config('globals.managers'))
                                    {{ Form::open(['method' => 'POST', 'class' =>'form-inline', 'route' => ['signups.status', $signup->id]]) }}
                                    {{ Form::select('status', config('globals.eventStatuses'), $signup->status ) }}
                                    &nbsp;<button type="submit" class="btn btn-secondary btn-sm"> Change</button>
                                    {{ Form::close() }}
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
@stop

@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD-MM-YYYY HH:mm');

            $('#signupsTableData').DataTable({
                order: [ 2, 'asc' ],
            });
        } );
    </script>
@stop