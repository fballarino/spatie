@extends('layouts.app')
@section('title','Bookings')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bookings of {{ $eventName }}</li>
                </ol>
            </nav>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <div class="table-responsive">
                    <table class="display nowrap" id="bookingsTableData">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Buyer</th>
                                <th>BNet Tag</th>
                                <th>Spec/Class</th>
                                <th># Boosters</th>
                                <th>Booked on</th>
                                <th>Notes</th>
                                <th>Advertiser</th>
                                <th>Amount</th>
                                <th>Paid</th>
                                <th>Collector</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($bookingsEventId as $booking)
                            <tr>
                                <td>{{ $booking->status }}
                                </td>
                                <td>{{ $booking->buyer_name }}-{{ $booking->buyer_realm }}</td>
                                <td>{{ $booking->buyer_btag }}</td>
                                <td>{{ $booking->buyer_spec }} {{$booking->class}}</td>
                                <td>{{ ($booking->buyer_boosters)? $booking->buyer_boosters : 0 }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y H:i') }}</td>
                                <td>{{ str_limit($booking->note, 30, $end = '...') }}</td>
                                <td>{{$booking->advertiser}}</td>
                                <td>@money(($booking->price - $booking->fee),"WOW")</td>
                                <td>
                                    @if($booking->fpaid)
                                        <i class="fas fa-check fa-lg"></i>
                                    @else
                                        <i class="fas fa-times-circle fa-lg"></i>
                                    @endif
                                </td>
                                <td>{{ ($booking->collector)? $booking->collector : "" }}</td>
                                <td>
                                    <a href="{{ route('bookings.edit', $booking->id) }}" >
                                        <i class="fas fa-edit fa-lg fa-lg"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                            <tfoot>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tfoot>
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
                $.fn.dataTable.moment('DD-MM-YYYY HH:mm');
                $('#bookingsTableData').DataTable({
                    order: [ 3, 'asc' ],
                });
            } );
        </script>
@stop