@extends('layouts.app')
@section('title',"Personal Signups")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Personal Signups</li>
                        </ol>
                    </nav>
                    <div class="card-body">
                        <h5 class="card-title">Future Signups</h5>
                        <p class="card-text"></p>
                        <table class="display nowrap" id="eventsTableData">
                            <thead>
                            <tr>
                                <th>Event Date</th>
                                <th>Event</th>
                                <th>Character</th>
                                <th>Signed on</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($signups_user as $signup)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($signup->run_at)->format('d M Y H:i') }}</td>
                                    <td>{{$signup->description}}</td>
                                    <td>{{$signup->name}}-{{$signup->realm}}</td>
                                    <td>{{ \Carbon\Carbon::parse($signup->created_at)->format('d M Y H:i') }}</td>
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
    </div>
@endsection
@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD MMM YYYY HH:mm');

            $('#eventsTableData').DataTable({
                order: [ 0, 'desc' ],
            });
        } );

        window.setTimeout(function() {
            $("#alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 5000);
    </script>
@stop