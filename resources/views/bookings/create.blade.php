@extends('layouts.app')
@section('title', '| Create New Booking')

@section('content')
<div class="container">
    <div class="row">
        <h3><i class="fas fa-calendar-alt"></i>
            <a href="{{ route('dashboard.index') }}">Dashboard </a>/
            <a href="{{ route('events.index') }}"> Events</a></h3>
        <hr>
    </div>
    <div class="row border">
        <div class="col-6">
            <p><h5>Create a new <b>Booking</b> for <b>{{$requestArray['ref']}}</b></h5></p>
        </div>
    </div>
    <hr>
    <form action="{{ route('bookings.store') }}" class="form-group" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-2">
                <label for="buyer_name"><h6><b>Name *</b></h6></label>
                <input name="buyer_name" value="{{old('buyer_name')}}" id="" class="form-control" />
            </div>
            <div class="col-3">
                <label for="buyer_realm"><h6><b>Realm *</b></h6></label>
                <input name="buyer_realm" value="{{old('buyer_realm')}}" id="" class="form-control" />
            </div>
            <div class="col-3">
                <label for="buyer_btag"><h6><b>Battle Net Tag</b></h6></label>
                <input name="buyer_btag" value="{{ (old('buyer_btag'))? old('buyer_btag') : "" }}" id="" class="form-control" />
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-2 form-group">
                <label for="class"><h6><b>Class</b></h6></label>
                <select name="class" id="A" class="form-control">
                    <option value="">Select...</option>
                    @foreach($classSpec as $key => $value)
                        <option value="{{$key}}">{{$key}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-3 form-group">
                <label for="buyer_spec"><h6><b>Spec</b></h6></label>
                <select name="buyer_spec" id="B" class="form-control">
                </select>
            </div>
            <div class="col-2 form-group">
                <label for="buyer_boosters"><h6><b># Boosters</b></h6></label>
                <select name="buyer_boosters" class="form-control">
                    <option value="" selected>Select if requested</option>
                    @for($counter = 0; $counter < 11; $counter++)
                        <option value="{{$counter}}">{{$counter}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <label for="price"><h6><b>Price *</b></h6></label>
                <input name="price" value="{{old('price')}}" id="" class="form-control" />
            </div>
            <div class="col-1">
                <label for="fee"><h6><b>Fee</b></h6></label>
                <input name="fee" value="{{ (old('fee'))? old('fee') : ""}}" id="" value="0" class="form-control" />
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3">
                <label for="note"><h6><b>Notes</b></h6></label>
                <textarea name="note" id="" class="form-control"></textarea>
            </div>
            <div class="col-2">
                <label for="fpaid"><h6><b>Fully Paid</b></h6></label>
                <select name="fpaid" id="fpaid" class="form-control">
                    <option value="0" selected>No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div class="col-1 form-inline">
                <input type="hidden" name="event_id" value="{{$requestArray['id']}}">
                {{ Form::button('Create', ['type' => 'submit', 'class' => 'btn btn-default']) }}
            </div>
            <div class="col-1">
            </div>
            <div class="col-4">
                <ul>
                    <li>Fields marked with * are mandatory.</li>
                    <li>Prices have to be inputed in (K) Es. 1,200,000 is entered as 1200</li>
                    <li>Remember to collect the 10% fee</li>
                </ul>
            </div>
        </div>
    </form>
</div>

@endsection
@section('javascript')
    @parent
    <script>
        (function() {
            var bOptions = <?php echo json_encode($classSpec); ?>;
            var A = document.getElementById('A');
            var B = document.getElementById('B');

            A.onchange = function() {
            B.length = 0;
            var _val = this.options[this.selectedIndex].value;
            for (var i in bOptions[_val]) {
            var op = document.createElement('option');
            op.value = bOptions[_val][i];
            op.text = bOptions[_val][i];
            B.appendChild(op);
            }
        };
        A.onchange();
        })();
    </script>
@stop