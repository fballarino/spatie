@extends('layouts.app')
@section('title', 'Character List')

@section('content')
    <div class="container">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Character List</li>
                </ol>
            </nav>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <div class="table-responsive">
                    <table class="display nowrap" id="charactersTableData">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name-Realm</th>
                            <th>Spec / Class</th>
                            <th>Item Level</th>
                            <th>Wowprogress</th>
                            <th>Last Update</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($allCharacters as $character)
                            <tr>
                                <td>{{ $character->id }}</td>
                                <td>{{ $character->name }}-{{ $character->realm }}</td>
                                <td>{{ $character->mainspec }}  {{ $character->class }}</td>
                                <td>{{ $character->gear }}</td>
                                <td><a href="{{ $character->wowprogress }}" target="_blank">Open</a></td>
                                <td>{{ \Carbon\Carbon::parse($character->updated_at)->format('d M Y H:i') }}</td>
                                <td>
                                    @can('Character Edit')
                                        <a href="{{ route('characters.edit', $character->id) }}" ><i class="fas fa-edit fa-lg"></i></a>
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
            <div class="card-footer text-muted">
                {{ \Illuminate\Support\Facades\Auth::user()->name }}
            </div>
        </div>



    </div>
@endsection
@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD MMM YYYY HH:mm');

            $('#charactersTableData').DataTable({
                order: [ 1, 'asc' ],
            });
        } );
    </script>
@stop