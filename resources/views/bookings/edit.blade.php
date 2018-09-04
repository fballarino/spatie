@extends('layouts.app')

@section('title', '| Create New Product')

@section('content')
    <div class="container">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Booking of {{ $booking->buyer_name }}-{{ $booking->buyer_realm }}</li>
                </ol>
            </nav>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                {{-- Using the Laravel HTML Form Collective to create our form --}}
                {{ Form::model($booking, array('route' => array('bookings.update', $booking->id), 'method' => 'PUT')) }}

                <div class="row">
                    <div class="col-2">
                        <h6><b>{{ Form::label('buyer_name', 'Name *') }}</b></h6>
                        {{ Form::text('buyer_name', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="col-3">
                        <h6><b>{{ Form::label('buyer_realm', 'Realm *') }}</b></h6>
                        {{ Form::text('buyer_realm', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="col-3">
                        <h6><b>{{ Form::label('buyer_btag', 'Battle Net Tag') }}</b></h6>
                        {{ Form::text('buyer_btag', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-2 form-group">
                        <label for="class"><h6><b>Class</b></h6></label>
                        <select name="class" id="A" class="form-control">
                            <option value="{{$booking->class}}">{{$booking->class}}</option>
                            @foreach($classSpec as $key => $value)
                                @if($booking->class != $key)
                                    <option value="{{$key}}">{{$key}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 form-group">
                        <label for="buyer_spec"><h6><b>Spec</b></h6></label>
                        <select name="buyer_spec" id="B" class="form-control">
                            <option value="{{$booking->buyer_spec}}">{{$booking->buyer_spec}}</option>
                        </select>
                    </div>
                    <div class="col-2 form-group">
                        <label for="buyer_boosters"><h6><b># Boosters</b></h6></label>
                        {{Form::select('buyer_boosters', [ 0 => 0, 1 => 1, 2 => 2,
                                                           3 => 3, 4 => 4, 5 => 5,
                                                           6 => 6, 7 => 7, 8 => 8,
                                                           9 => 9, 10 => 10
                                                     ], $booking->buyer_boosters, ['class' => 'form-control'])}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <h6><b>{{ Form::label('price', 'Price') }}</b></h6>
                        {{ Form::text('price', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="col-2">
                        <h6><b>{{ Form::label('fee', 'Fee') }}</b></h6>
                        {{ Form::text('fee', null, array('class' => 'form-control')) }}
                    </div>
                    {{ Form::hidden('event_id', $booking->event_id) }}
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <h6><b>{{ Form::label('note', 'Note') }}</b></h6>
                        {{ Form::textarea('note', null, array('class' => 'form-control',  'rows' => 5, 'cols' => 80)) }}
                    </div>
                    <div class="col-2">
                        <h6><b>{{ Form::label('fpaid', 'Fully Paid') }}</b></h6>
                        {{ Form::select('fpaid', [0 => 'No', 1 => 'Yes'], null, array('class' => 'form-control')) }}
                    </div>
                    <div class="col-1 form-inline">
                        {{ Form::submit('Edit Booking', array('class' => 'btn btn-default')) }}
                        {{ Form::close() }}
                    </div>
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
        (function() {
            var bOptions = <?php echo json_encode($classSpec); ?>;
            var A = document.getElementById('A');
            var B = document.getElementById('B');
            var currentSpec = <?php echo json_encode($booking->buyer_spec); ?>;
            console.log(currentSpec);
            A.onchange = function() {
                B.length = 0;
                var _val = this.options[this.selectedIndex].value;
                for (var i in bOptions[_val]) {
                    var op = document.createElement('option');
                    op.value = bOptions[_val][i];
                    op.text = bOptions[_val][i];
                    if(currentSpec == op.value){
                        op.setAttribute('selected', 'selected');
                    }
                    B.appendChild(op);
                }
            };
            A.onchange();
        })();
    </script>
@stop