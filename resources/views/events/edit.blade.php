@extends('layouts.app')
@section('title', '| Create New Event')
@section('content')
    <div class="container">
        <div class="row">
            <h3><i class="fas fa-calendar-alt"></i>
                <a href="{{ route('dashboard.index') }}">Dashboard </a>/
                <a href="{{ route('events.index') }}"> Events</a> / Event: {{$event->reference}}</h3>
        </div>
        <hr>
        {{-- Using the Laravel HTML Form Collective to create our form --}}
        {{ Form::model($event, array('route' => array('events.update', $event->id), 'method' => 'PUT')) }}
        {{ csrf_field() }}
        <div class="row">
            <div class="col-3 form-group">
                <label for="product_name"><h6><b>Product</b></h6></label>
                <select id='A' name="product_name" class="form-control">
                    <option value="{{$event->product_name}}">{{$event->product_name}}</option>

                </select>
            </div>
            <div class="col-3 form-group">
                    <label for="difficulty"><h6><b>Difficulty</b></h6></label>
                    <select id='B' name="difficulty" class="form-control">
                        <option value="{{$event->difficulty}}" selected>{{$event->difficulty}}</option>
                    </select>
            </div>
            <div class="col-2 form-group">
                <h6><b>{{ Form::label('buyers', 'Buyers Slots') }}</b></h6>
                {{ Form::text('buyers', null, array('class' => 'form-control')) }}
            </div>
            <div class="col-2 form-group">
                <h6><b>{{ Form::label('boosters', 'Boosters Slots') }}</b></h6>
                {{ Form::text('boosters', null, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="row">
            <div class="col-3 form-group">
                <h6><b>{{ Form::label('run_at', 'Event Date') }}</b></h6>
                <?php $dateTempOne = DateTime::createFromFormat('Y-m-d H:i:s', $event->run_at);
                $dateTempOne = $dateTempOne->format('H:i m/d/Y'); ?>
                <input type="text" id="input" class="form-control" name="run_at" value="{{$dateTempOne}}">
            </div>
            <div class="col-3 form-group">
                <h6><b>{{ Form::label('visible_at', 'Show Event on') }}</b></h6>
                <?php $dateTempOne = DateTime::createFromFormat('Y-m-d H:i:s', $event->visible_at);
                $dateTempOne = $dateTempOne->format('H:i m/d/Y'); ?>
                <input type="text" id="input2" class="form-control" name="visible_at" value="{{$dateTempOne}}">
            </div>
            <div class="col-2 form-group">
                <label for="overbooking"><h6><b>Overbooking Allowed</b></h6></label>
                {{Form::select('overbooking', [ 0 => 'No', 1 => 'Yes'], $event->overbooking,
                                              ['class' => 'form-control'])}}
            </div>
            <div class="col-2 form-group">
                <h6><b>{{ Form::label('status', 'Event Status') }}</b></h6>
                {{ Form::select('status', $eventProgress, null, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <h6><b>{{ Form::label('note', 'Note') }}</b></h6>
                {{ Form::textarea('note', null, array('class' => 'form-control',  'rows' => 2, 'cols' => 40)) }}
            </div>
            <div class="col-2">
                {{ Form::button('Update',  ['type' => 'submit', 'class' => 'btn btn-default btn-sm']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
@section('javascript')
    @parent
    <script>
        $('#input').datetimepicker({
            footer: true,
            modal: true,
        });
        $('#input2').datetimepicker({ footer: true, modal: true });
        var jArray = <?php echo json_encode($eventDifficulty); ?>;

    (function() {
    //setup an object fully of arrays
    //alternatively it could be something like
    //{"yes":[{value:sweet, text:Sweet}.....]}
    //so you could set the label of the option tag something different than the name


        var bOptions = <?php echo json_encode($eventDifficulty); ?>;
        var currentDifficulty = <?php echo json_encode($event->difficulty); ?>;
        //{
            //"Uldir": ["Normal", "Heroic", "Mythic"],
            //"Mythic Plus": ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10",],
            //"Island Expedition": ["Normal", "Heroic", "Mythic"],
        //};

        var A = document.getElementById('A');
        var B = document.getElementById('B');

        //on change is a good event for this because you are guarenteed the value is different
        A.onchange = function() {
        //clear out B
        B.length = 0;
        //get the selected value from A
        var _val = this.options[this.selectedIndex].value;
        //loop through bOption at the selected value
        for (var i in bOptions[_val]) {
            //create option tag
            var op = document.createElement('option');
            //set its value
            op.value = bOptions[_val][i];
            //set the display label
            op.text = bOptions[_val][i];
            if(currentDifficulty == op.text){
                op.setAttribute('selected', 'selected');
            }
            //append it to B
            B.appendChild(op);
        }
    };
    //fire this to update B on load
    A.onchange();

    })();
    </script>
@stop
