@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('attendances.index')}}">Attendances</a></li>
                <li class="breadcrumb-item active" aria-current="page">Attendance Event {{$data[3]}}</li>
            </ol>
        </nav>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <form>
                    <div class="row">
                        <div class="col-2">
                            <label for="inputEmail4"><h7>Pot</h7></label>
                            <input type="text" disabled value="{{$data[4]}}" class="form-control w-75">
                        </div>
                        <div class="col-2">
                            <label for="inputEmail4"><h7>Leader</h7></label>
                            <input type="text" disabled value="{{$data[5]}}" class="form-control w-75">
                        </div>
                    </div>
                </form>
                <p></p>
                <div class="row">
                    <table class="display nowrap" id="signupsTableData">
                        <thead>
                        <tr>
                            <th>Signup ID</th>
                            <th>Character</th>
                            <th>Signed on</th>
                            <th>in Raid Status</th>
                            <th>Cut</th>
                            <th>Leader Cut</th>
                            <th></th>
                            <th>Partecipation</th>
                            <th>Operations</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($signups as $signup)
                            <tr>
                                <td>{{ $signup->id }}</td>
                                <td>{{ $signup->character->name }}-{{ $signup->character->realm }}</td>
                                <td>{{ \Carbon\Carbon::parse($signup->created_at)->format('d M Y H:i') }}</td>
                                <td>{{ $signup->status }}</td>
                                @if(!$signup->attendance)
                                    <td>
                                        <form action="{{route('attendances.store')}}" method="post">
                                            {{csrf_field()}}
                                            <input type="hidden" name="signup_id" value="{{$signup->id}}">
                                            <input type="text" name="cut" class="form-control-sm w-75">
                                    </td>
                                    <td>
                                        <input type="text" name="leader_cut" class="form-control-sm w-50">

                                    </td>
                                    <td>
                                        <input type="checkbox" name="is_leader" class="form-inline">
                                    </td>
                                    <td>
                                        <select name="status" id="">
                                            @for($counter = 1; $counter <= 2; $counter++)
                                                <option value="{{$counter}}">{{$data[$counter]}}</option>
                                            @endfor
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit" name="submit">Confirm</button>
                                        </form>
                                    </td>
                                @else
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Attendance Tracked</td>
                                    <td></td>
                                @endif
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

            $('#signupsTableData').DataTable({
                order: [ 2, 'asc' ],
            });
        } );

        window.setTimeout(function() {
            $("#alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 5000);
    </script>
@stop