@extends('layouts.app')
@section('title', 'Edit Character')

@section('content')
<div class="container">
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('characters.index')}}">Characters</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Character</li>
            </ol>
        </nav>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text"></p>
            {{ Form::model($character, array('route' => array('characters.update', $character->id), 'method' => 'PUT')) }}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-2">
                    <label for="name"><h6>Name</h6></label>
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-3">
                    <label for="realm"><h6>Realm</h6></label>
                    {{ Form::text('realm', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-2">
                    <label for="main"><h6>Main Character</h6></label>
                    {{Form::select('main', [ 0 => 'No', 1 => 'Yes'], $character->main,
                                   ['class' => 'form-control'])}}
                </div>
                <div class="col-3">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2 form-group">
                    <label for="class"><h6>Class</h6></label>
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
                    <label for="mainspec"><h6>Main Spec</h6></label>
                    <select name="mainspec" id="B" class="form-control">
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="wowprogress"><h6>Wowprogress</h6></label>
                    {{ Form::text('wowprogress', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-2">
                    <label for="gear"><h6>Item Level</h6></label>
                    {{ Form::text('gear', null, array('class' => 'form-control w-50')) }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-1 form-inline">
                    <button type="submit" class="btn btn-outline-primary"><i class="far fa-edit"></i> Edit</button>
                    {{ Form::close() }}
                </div>
                <div class="col-1 form-inline">
                    @can('Character Delete')
                        {!! Form::open(['method' => 'DELETE', 'class' =>'form-inline', 'route' => ['characters.destroy', $character->id] ]) !!}
                            <button type="submit" class="btn btn-outline-danger"><i class="far fa-times-circle"></i> Delete</button>
                        {!! Form::close() !!}
                    @endcan
                </div>
                <div class="col-4">
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