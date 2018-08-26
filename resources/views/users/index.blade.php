{{-- \resources\views\users\dashboard.php --}}
@extends('layouts.app')

@section('title', '| Users')

@section('content')

    <div class="container-fluid">
        <div class="row">
        <h3>
            <i class="fa fa-users"></i>
            <a href="{{ route('dashboard.index') }}">Dashboard </a>/ User Administration
            <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
            <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h3>
        <hr>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="usersDataTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Last Update</th>
                    <th>User Role/s</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                        <td>{{ $user->updated_at->format('d M Y H:i') }}</td>
                        {{-- Retrieve array of roles associated to a user and convert to string --}}
                        <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>
    </div>
@endsection
@section('javascript')
    @parent
<script>
    $(document).ready( function () {
        $('#usersDataTable').DataTable();
    } );
</script>
@stop
