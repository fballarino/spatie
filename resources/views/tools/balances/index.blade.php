@extends('layouts.app')
@section('title',"Oblivion Events")
@section('content')
    <div class="container-fluid">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tools > Balances</li>
                </ol>
            </nav>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <div class="table-responsive">
                    <table class="display nowrap" id="usersTableData">
                        <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Faction</th>
                            <th>Name</th>
                            <th>Earned</th>
                            <th>Received</th>
                            <th>Balance</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>({{ $user->faction->faction }})</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <a href="{{ route('balances.tools.attendance', $user->id) }}">
                                    @money((($user->attendances->sum('cut'))+($user->attendances->sum('leader_cut'))),"WOW")</a>
                                </td>
                                <td>@money(abs($user->transactions->sum('amount')),"WOW") </td>
                                <td>@money(((($user->attendances->sum('cut'))+($user->attendances->sum('leader_cut'))) -
                                    (abs($user->transactions->sum('amount')))),"WOW")</td>
                                <td>Actions</td>
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
@endsection
@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD MMM YYYY HH:mm');

            $('#usersTableData').DataTable({
                order: [ 2, 'asc' ],
                "pageLength": 50
            });
        } );
    </script>
@stop