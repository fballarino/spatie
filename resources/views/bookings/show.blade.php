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
                                    <a href="{{ route('bookings.edit', $booking->id) }}" >
                                        <i class="fas fa-edit fa-lg fa-lg"></i></a>
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
                $.fn.dataTable.moment('DD-MM-YYYY HH:mm');
                $('#bookingsTableData').DataTable({
                    order: [ 3, 'asc' ],
                });
            } );
        </script>
@stop