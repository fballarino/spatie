@extends('layouts.app')
@section('title', '| Create New Event')
@section('content')
    <div class="container">
        <div class="row">
            <h3><i class="fas fa-calendar-alt"></i>
                <a href="{{ route('dashboard.index') }}">Dashboard </a>/
                <a href="{{ route('events.index') }}"> Events</a> / Creating Event</h3>
            <hr>
        </div>
        <hr>
        <form action="{{ route('events.store') }}" class="form-group" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-3 form-group">
                    <label for="product_name"><h6><b>Product</b></h6></label>
                        <select id='A' name="product_name" class="form-control">
                            <option value="">Select...</option>
                            @foreach($eventDiff as $key => $value)
                                <option value="{{$key}}">{{$key}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="col-2 form-group">
                    <label for="difficulty"><h6><b>Difficulty</b></h6></label>
                    <select id='B' name="difficulty" class="form-control">
                    </select>
                </div>
                <div class="col-2 form-group">
                    <label for="buyers"><h6><b>Buyers Slots</b></h6></label>
                    <input name="buyers" id="buyers" class="form-control" />
                </div>
                <div class="col-2 form-group">
                    <label for="boosters"><h6><b>Boosters Slots</b></h6></label>
                    <input name="boosters" id="boosters" class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3 form-group">
                    <label for="run_at"><h6><b>Event Date</b></h6></label>
                    <input name="run_at" id="input" class="form-control" />
                </div>
                <div class="col-2 form-group">
                    <label for="visible_at"><h6><b>Show Event on</b></h6></label>
                    <input name="visible_at" id="input2" class="form-control" />
                </div>
                <div class="col-2 form-group">
                    <label for="overbooking"><h6><b>Overbooking Allowed</b></h6></label>
                    <select name="overbooking" class="form-control">
                        <option value="" selected>Select...</option>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="note"><h6><b>Info</b></h6></label>
                    <textarea name="note" id="note" class="form-control" placeholder="notes..."></textarea>
                </div>
                <div class="col-2">
                    {{ Form::button('<i class="fas fa-plus fa-2x"></i> Create',  ['type' => 'submit',
                                                                                  'class' => 'btn btn-default btn-sm',
                                                                                 ]) }}
                </div>
            </div>
        </form>
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
        var jArray = <?php echo json_encode($eventDiff); ?>;

    (function() {
    //setup an object fully of arrays
    //alternatively it could be something like
    //{"yes":[{value:sweet, text:Sweet}.....]}
    //so you could set the label of the option tag something different than the name


        var bOptions = <?php echo json_encode($eventDiff); ?>;
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
            //append it to B
            B.appendChild(op);
        }
    };
    //fire this to update B on load
    A.onchange();

    })();
    </script>
@stop
