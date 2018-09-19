@extends('layouts.app')
@section('title',"Goldtrack Management")
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Goldtrack</li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <form action="{{ route('goldtracks.verify') }}" method="post">
                            {{csrf_field()}}
                            {{method_field('POST')}}
                            <table class="" id="goldtracksDataTable">
                                <thead class="">
                                <th>Booking ID</th>
                                <th>Event</th>
                                <th>Buyer</th>
                                <th>Code</th>
                                <th>Amount</th>
                                <th>Collector</th>
                                <th>Date/Time</th>
                                <th>Verified</th>
                                <th>Operations</th>
                                </thead>
                                <tbody>
                                <p></p>
                                @foreach($goldtracks as $goldtrack)
                                    <tr>
                                        <td>{{ $goldtrack->booking->id }}</td>
                                        <td>{{ $goldtrack->event->reference }}</td>
                                        <td>
                                            {{ $goldtrack->booking->buyer_name }}-{{ $goldtrack->booking->buyer_realm }}
                                        </td>
                                        <td>{{ $goldtrack->code }}</td>
                                        <td>@money($goldtrack->amount, "WOW")</td>

                                        <td>{{ $goldtrack->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($goldtrack->created_at)->format('d M Y H:i') }}</td>
                                        <td>
                                            @if($goldtrack->verified)
                                                <input type="checkbox" disabled checked>
                                                {{ $goldtrack->verified_by }}
                                            @else
                                                <input type="checkbox" name="{{$goldtrack->id}}">
                                            @endif
                                        </td>
                                        <td>
                                            @hasrole(config('globals.collectors'))
                                            <a href="{{ route('goldtracks.show', $goldtrack->id) }}">
                                                <i class="far fa-eye fa-lg"></i></a>
                                            <a href="{{ route('goldtracks.edit', $goldtrack->id) }}">
                                                <i class="far fa-edit fa-lg"></i></a>
                                            <a href="{{ route('refund.create_refund', $goldtrack->id) }}">
                                                <i class="far fa-money-bill-alt fa-lg"></i></a>
                                            @endhasrole
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td>
                                        @hasrole(config('globals.accountants'))
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="far fa-check-square"></i> Verify</button>
                                        @endhasrole
                                    </td>
                                    <td></td><td></td>
                                </tr>
                                </tfoot>
                            </table>

                        </form>
                    </div>
                    <div class="col-1"></div>
                </div>
            </div>
                <div class="card-footer text-muted">
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                </div>
            </div>
    </div>
@stop
@section('javascript')
@parent
<script>
    $(document).ready(function() {
        $.fn.dataTable.moment('DD MMM YYYY HH:mm');

        $('#goldtracksDataTable').DataTable({
            order: [ 7, 'desc' ],
            "LengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "pageLength": 25
        });
    } );
</script>
@stop