@extends('layouts.app')
@section('title', '| Create New Character')

@section('content')
    <div class="container">
        <!-- Main Navigation Bar -->
        <div class="row">
            <h3><i class="fas fa-calendar-alt"></i>
                <a href="{{ route('dashboard.index') }}">Dashboard </a>/
                <a href="{{ route('events.index') }}"> Events </a>/
                <a href="{{ route('characters.index') }}"> Characters </a>
            </h3>
            <hr>
        </div>
        <div class="row border">
            <div class="col-6">
                <p><h5>Updating <b>Char Name Here</b></h5></p>
            </div>
        </div>
        <hr>
        <!-- Main Navigation Bar Ends Here -->

        <!-- Laravel HTML Form Collective Model Binding -->
        {{ Form::model($character, array('route' => array('characters.update', $character->id), 'method' => 'PUT')) }}
        {{ csrf_field() }}
        <div class="row">
            <div class="col-2">
                <label for="name"><h6><b>Name</b></h6></label>
                {{ Form::text('name', null, array('class' => 'form-control')) }}
            </div>
            <div class="col-3">
                <label for="realm"><h6><b>Realm</b></h6></label>
                {{ Form::text('realm', null, array('class' => 'form-control')) }}
            </div>
            <div class="col-2">
                <label for="main"><h6><b>Main Character</b></h6></label>
                {{Form::select('main', [ 0 => 'No', 1 => 'Yes'], $character->main,
                               ['class' => 'form-control'])}}
            </div>
            <div class="col-3">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-2 form-group">
                <label for="class"><h6><b>Class</b></h6></label>
                <select name="class" id="A" class="form-control">
                    <option value="{{$character->class}}">{{$character->class}}</option>
                    @foreach($classSpec as $key => $value)
                        @if($character->class != $key)
                            <option value="{{$key}}">{{$key}}</option>
                        @endif
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
                    {{ Form::text('wowprogress', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-2">
                    <label for="gear"><h6><b>Item Level</b></h6></label>
                    {{ Form::text('gear', null, array('class' => 'form-control w-50')) }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-1 form-inline">
                    {{ Form::button('Edit', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                </div>
                <div class="col-1">
                </div>
                <div class="col-4">
                </div>
            </div>
        {{ Form::close() }}
        <!-- End of Form -->
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