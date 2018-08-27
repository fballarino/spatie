@extends('layouts.app')
@section('title', '| Create New Character')

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
                <p><h5>Create a new <b>Character</b> for <b>{{Auth::user()->name}}</b></h5></p>
            </div>
        </div>
        <hr>
        <form action="{{ route('characters.store') }}" class="form-group" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-2">
                    <label for="name"><h6><b>Name</b></h6></label>
                    <input name="name" value="{{old('name')}}" id="" class="form-control" />
                </div>
                <div class="col-3">
                    <label for="realm"><h6><b>Realm</b></h6></label>
                    <input name="realm" value="{{old('realm')}}" id="" class="form-control" />
                </div>
                <div class="col-2">
                    <label for="main"><h6><b>Main Character</b></h6></label>
                    <select name="main" id="main" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div class="col-3">
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
                    <label for="mainspec"><h6><b>Main Spec</b></h6></label>
                    <select name="mainspec" id="B" class="form-control">
                    </select>
                </div>
                <div class="col-3 form-group">
                    <label for="offspec"><h6><b>Off Spec</b></h6></label>
                    <select name="offspec" id="C" class="form-control">
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="wowprogress"><h6><b>Wowprogress</b></h6></label>
                    <input name="wowprogress" value="{{old('price')}}" id="" class="form-control" />
                </div>
                <div class="col-2">
                    <label for="gear"><h6><b>Item Level</b></h6></label>
                    <input name="gear" value="{{ (old('fee'))? old('fee') : ""}}" id="" value="0" class="form-control w-50" />
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-1 form-inline">
                    {{ Form::button('Create', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                </div>
                <div class="col-1">
                </div>
                <div class="col-4">
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
            //var C = document.getElementById('C');

            A.onchange = function() {
                B.length = 0;
                //C.length = 0;
                var _val = this.options[this.selectedIndex].value;
                for (var i in bOptions[_val]) {
                    var op = document.createElement('option');
                    op.value = bOptions[_val][i];
                    op.text = bOptions[_val][i];
                    B.appendChild(op);
                    //C.appendChild(op);
                }
            };
            A.onchange();
        })();
    </script>
@stop