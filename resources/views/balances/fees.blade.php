@extends('layouts.app')
@section('title',"Fees Collected")
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="card">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('balances.index')}}">Balance</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Fees collected</li>
                        </ol>
                    </nav>
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text"></p>
                        <table class="display nowrap" id="eventsTableData">
                            <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Event</th>
                                <th>Buyer</th>
                                <th>Buyer Bnet</th>
                                <th>Price</th>
                                <th>Fee</th>
                                <th>Booked on</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($fees_advertiser as $fee_booking)
                                <tr>
                                    <td>{{$fee_booking->id}}</td>
                                    <td>{{$fee_booking->event->reference}} on
                                        {{ \Carbon\Carbon::parse($fee_booking->event->run_at)->format('d M Y H:i') }}</td>
                                    <td>{{$fee_booking->buyer_name}}-{{$fee_booking->buyer_realm}}</td>
                                    <td>{{$fee_booking->buyer_btag}}</td>
                                    <td>@money($fee_booking->price,"WOW")</td>
                                    <td>@money($fee_booking->fee,"WOW")</td>
                                    <td>{{ \Carbon\Carbon::parse($fee_booking->created_at)->format('d M Y H:i') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total:</td>
                                    <td>@money($fees_total,"WOW")</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                </div>
            </div>
            <div class="col-1"></div>
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