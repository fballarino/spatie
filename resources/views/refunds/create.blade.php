@extends('layouts.app')
@section('title', 'Creating Refund')

@section('content')
    <div class="container">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Refund</li>
                </ol>
            </nav>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <form action="{{ route('refunds.store') }}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-4 form-group">
                            <label for="booking_id">Event Reference</label>
                            <input type="text" readonly name="booking_event_reference" class="form-control"
                                   value="{{$goldtrack->booking->event->reference}}">
                        </div>
                        <div class="col-4 form-group">
                            <label for="booking_name">Buyer</label>
                            <input type="text" readonly name="booking_buyer_name" class="form-control"
                                   value="{{$goldtrack->booking->buyer_name}}-{{$goldtrack->booking->buyer_realm}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 form-group">
                            <label for="booking_price">Booking Price</label>
                            <input type="text" readonly name="booking_price" class="form-control"
                                   value="@money($goldtrack->booking->price, 'WOW')">
                        </div>
                        <div class="col-2 form-group">
                            <label for="full_refund">Refund</label>
                            <select name="full_refund" class="form-control" id="full_refund">
                                <option value="">Select...</option>
                                @foreach(config('globals.refund_cases') as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2 form-group">
                            <label for="amount" id="label_amount" style="display:none;">Refunded</label>
                            <input type="text" name="amount" class="form-control" id="amount" style="display:none;">
                        </div>
                        <div class="col-3 form-group">
                            <label for="reason_id">Reason</label>
                            <select name="reason_id"  class="form-control">
                                <option value="">Select...</option>
                                @foreach(config('globals.refund_reasons') as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="goldtrack_id" value="{{$goldtrack->id}}">
                            <input type="hidden" name="booking_id" value="{{$goldtrack->booking->id}}">
                            <input type="hidden" name="event_id" value="{{$goldtrack->event->id}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <textarea name="note" id="" cols="80" rows="8" placeholder="Optional info..."></textarea>
                        </div>
                        <div class="col-2 form-inline">
                            <button type="submit" class="btn btn-outline-primary">Create</button>
                        </div>
                    </div>
                </form>
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
        $(document).ready(function (){
            $("#full_refund").change(function() {
                // foo is the id of the other select box
                if ($(this).val() == "0") {
                    $("#amount").show();
                    $("#label_amount").show();
                }else{
                    $("#amount").hide();
                    $("#label_amount").hide();
                }
            });
        });
    </script>
@stop
