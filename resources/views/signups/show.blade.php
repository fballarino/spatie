@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>
                <i class="fas fa-calendar-alt"></i>
                <a href="{{ route('dashboard.index') }}">Dashboard </a>/
                <a href="{{ route('events.index') }}">Events </a> /
                <a href="{{ route('events.index') }}">Attendances </a></h3>
            <hr>
        </div>
        <p></p>
        <form>
            <div class="row">
                <div class="col-3">
                    <label for="inputEmail4"><h7><b>Reference</b></h7></label>
                    <input type="text" disabled value="{{$data[0]}}" class="form-control">
                </div>
                <div class="col-2">
                    <label for="inputEmail4"><h7><b>Booster Cut</b></h7></label>
                    <input type="text" disabled value="{{$data[1]}}" class="form-control w-75">
                </div>
                <div class="col-2">
                    <label for="inputEmail4"><h7><b>Leader Cut</b></h7></label>
                    <input type="text" disabled value="{{$data[2]}}" class="form-control w-75">
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
                            <td>do stuff</td>
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