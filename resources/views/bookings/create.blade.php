@extends('layouts.app')
@section('title', 'Create New Booking')

@section('content')
<div class="container">
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Booking</li>
            </ol>
        </nav>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text"></p>
            <form action="{{ route('bookings.store') }}" class="form-group" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-2">
                        <label for="buyer_name"><h6>Name *</h6></label>
                        <input name="buyer_name" value="{{old('buyer_name')}}" id="" class="form-control" />
                    </div>
                    <div class="col-3">
                        <label for="buyer_realm"><h6>Realm *</h6></label>
                        <input name="buyer_realm" value="{{old('buyer_realm')}}" id="" class="form-control" />
                    </div>
                    <div class="col-3">
                        <label for="buyer_btag"><h6>Battle Net Tag</h6></label>
                        <input name="buyer_btag" value="{{ (old('buyer_btag'))? old('buyer_btag') : "" }}" id="" class="form-control" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-2 form-group">
                        <label for="class"><h6>Class</h6></label>
                        <select name="class" id="A" class="form-control">
                            <option value="">Select...</option>
                            @foreach($classSpec as $key => $value)
                                <option value="{{$key}}">{{$key}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 form-group">
                        <label for="buyer_spec"><h6>Spec</h6></label>
                        <select name="buyer_spec" id="B" class="form-control">
                        </select>
                    </div>
                    <div class="col-3 form-group">
                        <label for="buyer_boosters"><h6># Boosters</h6></label>
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
                        <label for="price"><h6>Price *</h6></label>
                        <input name="price" value="{{old('price')}}" id="" class="form-control" />
                    </div>
                    <div class="col-2">
                        <label for="fee"><h6>Fee</h6></label>
                        <input name="fee" value="{{ (old('fee'))? old('fee') : ""}}" id="" value="0" class="form-control" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <label for="note"><h6>Notes</h6></label>
                        <textarea name="note" rows="6" cols="80" id="" class="form-control"></textarea>
                    </div>
                    <div class="col-2">
                        <label for="fpaid"><h6>Fully Paid</h6></label>
                        <select name="fpaid" id="fpaid" class="form-control">
                            <option value="0" selected>No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-1 form-inline">
                        <input type="hidden" name="event_id" value="{{$requestArray['id']}}">
                        {{ Form::button('Create', ['type' => 'submit', 'class' => 'btn btn-outline-primary']) }}
                    </div>
                    <div class="col-1">
                    </div>
                    <div class="col-4">
                        <div class="card bg-light mb-3" style="max-width: 18rem;">
                            <div class="card-header">Instructions</div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">Fields with * are mandatory</li>
                                    <li class="list-group-item">Price and fee must be entered in the full format</li>
                                    <li class="list-group-item">If you select fully paid that line goes straight in the Goldtrack, use it carefully as you are responsible for that</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-muted">
                {{ \Illuminate\Support\Facades\Auth::user()->name }}
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