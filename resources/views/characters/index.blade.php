@extends('layouts.app')
@section('title', '| Create New Character')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h3><i class="fas fa-calendar-alt"></i>
                <a href="{{ route('dashboard.index') }}">Dashboard </a>/
                <a href="{{ route('events.index') }}"> Events</a> / Characters</h3>
            <hr>
        </div>
        <div class="table-responsive">
            <table class="display nowrap" id="charactersTableData">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name-Realm</th>
                    <th>Spec / Class</th>
                    <th>Offspec</th>
                    <th>Item Level</th>
                    <th>Wowprogress</th>
                    @can('Character Main Status')<th>is Main</th>@endcan
                    <th>Last Update</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($allCharacters as $character)
                    <tr>
                        <td>{{ $character->id }}</td>
                        <td>{{ $character->name }} - {{ $character->realm }}</td>
                        <td>{{ $character->mainspec }}  {{ $character->class }}</td>
                        <td>{{ $character->offspec }}</td>
                        <td>{{ $character->gear }}</td>
                        <td><a href="{{ $character->wowprogress }}" target="_blank">Open</a></td>
                        <td>
                            @can('Character Main Status')
                                {{ Form::open(['method' => 'POST', 'class' =>'form-inline', 'route' => ['characters.status', $character->id] ]) }}
                                {{ Form::select('main', [0 => 'No', '1' => 'Yes'], $character->main , array('class' => 'form-control-sm')) }}
                                <div class="input-bar-item">
                                    <button class="btn btn-light"><i class="fab fa-accusoft"></i></button>
                                </div>
                                {!! Form::close() !!}
                            @endcan
                        </td>
                        <?php $dateTemp = DateTime::createFromFormat('Y-m-d H:i:s', $character->updated_at);
                        $dateTemp = $dateTemp->format('d M Y H:i');
                        ?>
                        <td>{{$dateTemp}}</td>
                        <td>
                            @can('Character Delete')
                                {!! Form::open(['method' => 'DELETE', 'class' =>'form-inline', 'route' => ['characters.destroy', $character->id] ]) !!}
                            @endcan
                            @can('Character Edit')
                                <div class="form-group">
                                    <a href="{{ route('characters.edit', $character->id) }}" ><i class="fas fa-edit fa-lg"></i></a>
                                </div>
                            @endcan
                            @can('Character Delete')
                                <div class="form-group">
                                    <div class="input-bar-item">
                                        <button class="btn btn-light"><i class="fas fa-trash fa-lg"></i></button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <br>
        @can('Character Create')
            <a href="{{ route('characters.create') }}" class="btn btn-success">Add Character</a></br>
        @endcan

    </div>
@endsection
@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD-MM-YYYY HH:mm');

            $('#charactersTableData').DataTable({
                order: [ 1, 'asc' ],
            });
        } );
    </script>
@stop