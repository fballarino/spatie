@extends('layouts.app')
@section('title', 'Create New Event')
@section('content')
<div class="container">
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('events.index')}}">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Event</li>
            </ol>
        </nav>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text"></p>
            <form action="{{ route('events.store') }}" class="form-group" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-3 form-group">
                        <label for="product_name"><h6>Product</h6></label>
                        <select id='A' name="product_name" class="form-control">
                            <option value="">Select...</option>
                            @foreach($eventDiff as $key => $value)
                                <option value="{{$key}}">{{$key}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2 form-group">
                        <label for="difficulty"><h6>Difficulty</h6></label>
                        <select id='B' name="difficulty" class="form-control">
                        </select>
                    </div>
                    <div class="col-2 form-group">
                        <label for="buyers"><h6>Buyers Slots</h6></label>
                        <input name="buyers" id="buyers" class="form-control" />
                    </div>
                    <div class="col-2 form-group">
                        <label for="boosters"><h6>Boosters Slots</h6></label>
                        <input name="boosters" id="boosters" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 form-group">
                        <label for="run_at"><h6>Event Date</h6></label>
                        <input name="run_at" id="input" class="form-control" />
                    </div>
                    <div class="col-3 form-group">
                        <label for="visible_at"><h6>Show Event on</h6></label>
                        <input name="visible_at" id="input2" class="form-control"
                               value="{{\Carbon\Carbon::parse(\Carbon\Carbon::now())->format('H:i m/d/Y')}}"/>
                    </div>
                    <div class="col-2 form-group">
                        <label for="overbooking"><h6>Overbooking</h6></label>
                        <select name="overbooking" class="form-control">
                            <option value="0" selected>No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-2 form-group">
                        <label for="leader_cut"><h6>Leader Cut</h6></label>
                        <input name="leader_cut" id="input2" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <label for="note"><h6>Info</h6></label>
                        <textarea rows="6" cols="80" name="note" id="note" class="form-control"
                                  placeholder="Notes..."></textarea>
                    </div>
                    <div class="col-2 form-inline">
                        {{ Form::button('Create',  ['type' => 'submit', 'class' => 'btn btn-outline-primary']) }}
                    </div>
                </div>
            </form>
        </div>
        <div class="col-2"></div>
        <div class="card-footer text-muted">
            {{ \Illuminate\Support\Facades\Auth::user()->name }}
        </div>
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
