@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h3><i class="fas fa-calendar-alt"></i>
                <a href="{{ route('dashboard.index') }}">Dashboard </a>/
                <a href="{{ route('events.index') }}"> Events</a> / Bookings for: {{ $eventName }}</h3>
            <hr>
        </div>
        <div class="table-responsive">
            <table class="display nowrap" id="bookingsTableData">
                <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Status</th>
                    <th>Buyer</th>
                    <th>Booked on</th>
                    <th>Advertiser</th>
                    <th>Amount</th>
                    <th>Paid</th>
                    <th>Collector</th>
                    <th>Spec/Class</th>
                    <th># Boosters Req.(Raid)</th>
                    <th>BNet Tag</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($bookingsEventId as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>
                            {!! Form::open(['method' => 'POST', 'class' =>'form-inline', 'route' => ['bookings.status', $booking->id] ]) !!}
                            {{ Form::select('status', ['Booked' => 'Booked', 'Backup' => 'Backup',
                                                       'Noshow' => 'Noshow', 'Grouped' => 'Grouped',
                                                       'Rebooked' => 'Rebooked'], $booking->status , array('class' => 'form-control-sm')) }}
                            <div class="input-bar-item">
                                <button class="btn btn-light"><i class="fab fa-accusoft"></i></i></button>
                            </div>
                            {!! Form::close() !!}
                        </td>
                        <td>{{ $booking->buyer_name }}-{{ $booking->buyer_realm }}</td>
                        <?php $dateTemp = DateTime::createFromFormat('Y-m-d H:i:s', $booking->created_at);
                        $dateTemp = $dateTemp->format('d M Y H:i');
                        ?>
                        <td>{{ $dateTemp }}</td>
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
                        <td>{{ $booking->buyer_spec }} {{$booking->class}}</td>
                        <td>{{ ($booking->buyer_boosters)? $booking->buyer_boosters : 0 }}</td>
                        <td>{{ $booking->buyer_btag }}</td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'class' =>'form-inline', 'route' => ['bookings.destroy', $booking->id] ]) !!}
                            <input type="hidden" name="event_id" value={{$booking->event_id}}>
                            <div class="form-group">
                                <a href="{{ route('bookings.edit', $booking->id) }}" ><i class="fas fa-edit fa-lg fa-lg"></i></a>
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