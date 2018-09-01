@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>
                <i class="fas fa-calendar-alt"></i>
                <a href="{{ route('dashboard.index') }}">Dashboard </a>/
                <a href="{{ route('events.index') }}">Events </a> /
                <a href="{{ route('attendances.index') }}">Attendances </a></h3>
            <hr>
        </div>
        <p></p>
        <form>
            <div class="row">
                <div class="col-3">
                    <label for="inputEmail4"><h7><b>Reference</b></h7></label>
                    <input type="text" disabled value="{{$data[3]}}" class="form-control">
                </div>
                <div class="col-2">
                    <label for="inputEmail4"><h7><b>Pot</b></h7></label>
                    <input type="text" disabled value="{{$data[4]}}" class="form-control w-75">
                </div>
                <div class="col-2">
                    <label for="inputEmail4"><h7><b>Leader Cut</b></h7></label>
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
                                    <input type="text" name="cut" value={{$data[6]}}>
                                </td>
                                <td>
                                    <input type="text" name="leader_cut" value={{$data[5]}}>
                                    <input type="checkbox" name="is_leader">
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
                                 <td><input type="text" disabled value={{$data[6]}}></td>
                                 <td><input type="text" disabled value={{($signup->is_leader)? $data[5] : 0}}>
                                     <input type="checkbox" disabled {{($signup->is_leader)? "checked" : ""}}>
                                 </td>
                                 <td>Attendance Tracked</td>
                                 <td></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

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