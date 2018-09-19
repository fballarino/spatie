@extends('layouts.app')
@section('title',"Refunds Management")
@section('content')
    <div class="container">
        <div class="card">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Refunds</li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <div class="row">
                    <div class="col-12">
                        <table id="refundsDataTable">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Booking</th>
                                <th>Event</th>
                                <th>Refunder</th>
                                <th>Amount</th>
                                <th>Reason</th>
                                <th>Note</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($refunds as $refund)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($refund->created_at)->format('d M Y H:i')}}</td>
                                        <td>{{$refund->booking->buyer_name}}-{{$refund->booking->buyer_realm}}</td>
                                        <td>{{$refund->booking->event->reference}}</td>
                                        <td>{{$refund->user->name}}</td>
                                        <td>@money($refund->amount, "WOW")</td>
                                        <td>{{$reasons[$refund->reason_id]}}</td>
                                        <td>{{$refund->note}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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

            $('#refundsDataTable').DataTable({
                order: [ 0, 'desc' ],
                "LengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
                "pageLength": 25
            });
        } );
    </script>
@stop