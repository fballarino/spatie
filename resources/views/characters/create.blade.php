@extends('layouts.app')
@section('title', 'Create New Character')

@section('content')
<div class="container">
    <div class="card">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('characters.index')}}">Characters</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Character</li>
        </ol>
    </nav>
    <div class="card-body">
        <h5 class="card-title"></h5>
        <p class="card-text"></p>
        <form action="{{ route('characters.store') }}" class="form-group" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-2">
                    <label for="name"><h6>Name</h6></label>
                    <input name="name" value="{{old('name')}}" id="" class="form-control" />
                </div>
                <div class="col-3">
                    <label for="realm"><h6>Realm</h6></label>
                    <select name="realm" id="realm" class="form-control">
                        <option value="" selected>Select...</option>
                        @foreach($realms as $realm)
                            <option value="{{$realm->realm}}">{{$realm->realm}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <label for="main"><h6>Main Character</h6></label>
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
                    <label for="class"><h6>Class</h6></label>
                    <select name="class" id="A" class="form-control">
                        <option value="">Select...</option>
                        @foreach($classSpec as $key => $value)
                            <option value="{{$key}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3 form-group">
                    <label for="mainspec"><h6>Main Spec</h6></label>
                    <select name="mainspec" id="B" class="form-control">
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="wowprogress"><h6>Wowprogress</h6></label>
                    <input name="wowprogress" value="{{old('price')}}" id="" class="form-control" />
                </div>
                <div class="col-2">
                    <label for="gear"><h6>Item Level</h6></label>
                    <input name="gear" value="{{ (old('fee'))? old('fee') : ""}}" id="" value="0" class="form-control w-50" />
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-1 form-inline">
                    {{ Form::button('Create', ['type' => 'submit', 'class' => 'btn btn-outline-primary']) }}
                </div>
                <div class="col-1">
                </div>
                <div class="col-4">
                </div>
            </div>
        </form>
    </div>
    <div class="col-2"></div>
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