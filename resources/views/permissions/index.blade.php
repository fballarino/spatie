{{-- \resources\views\permissions\dashboard.php --}}
@extends('layouts.app')

@section('title', '| Permissions')

@section('content')

    <div class="container">
        <h1><i class="fa fa-key"></i>Available Permissions

            <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>
            <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a></h1>
        <hr>

            <table class="table table-bordered table-striped" id="tablePermissions">
                <thead>
                <tr>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'class' =>'form-inline', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                            <div class="form-group">
                                <a href="{{ route('permissions.edit', $permission->id) }}" ><i class="fas fa-edit fa-lg fa-lg"></i></a>
                            </div>
                            <div class="form-group">
                                <div class="input-bar-item">
                                    <button class="btn btn-light"><i class="fas fa-trash fa-lg fa-lg"></i></button>
                                </div>
                            </div>
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        <a href="{{ URL::to('permissions/create') }}" class="btn btn-success">Add Permission</a>
    </div>
@endsection
@section('javascript')
    @parent
        <script>
            $(document).ready(function() {
                $.fn.dataTable.moment('DD-MM-YYYY HH:mm');

                $('#tablePermissions').DataTable({
                    order: [ 0, 'asc' ],
                    "scrollX": false,
                    "pageLength": 25
                });
            } );
        </script>
@stop