@extends('layouts.app')
@section('title', 'Editing Event')
@section('content')
<div class="container">
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('events.index')}}">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editing {{$event->reference}}</li>
            </ol>
        </nav>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text"></p>

        {{-- Using the Laravel HTML Form Collective to create our form --}}
        {{ Form::model($event, array('route' => array('events.update', $event->id), 'method' => 'PUT')) }}
        {{ csrf_field() }}
        <div class="row">
            <div class="col-5 form-group">
                <label for="article_id"><h6><b>Product</b></h6></label>
                    {{ Form::select('article_id', $articles, null, array('class' => 'form-control')) }}
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
                <label for="overbooking"><h6><b>Overbooking</b></h6></label>
                {{Form::select('overbooking', [ 0 => 'No', 1 => 'Yes'], $event->overbooking,
                                              ['class' => 'form-control'])}}
            </div>
            <div class="col-2 form-group">
                <h6><b>{{ Form::label('status', 'Event Status') }}</b></h6>
                <select name="status" id="" class="form-control">
                    @foreach($eventProgress as $key => $value)
                        @if($event->status == $value)
                            <option value="{{$value}}" selected>{{$value}}</option>
                        @else
                            <option value="{{$value}}">{{$value}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-3 form-group">
                <h6><b>{{ Form::label('note', 'Note') }}</b></h6>
                {{ Form::textarea('note', null, array('class' => 'form-control',  'rows' => 6, 'cols' => 80)) }}
            </div>
            <div class="col-2 form-inline">
                {{ Form::button('Update',  ['type' => 'submit', 'class' => 'btn btn-outline-primary']) }}
                {{ Form::close() }}
                &nbsp;
                @hasrole(config('globals.executives'))
                    {!! Form::open(['method' => 'DELETE', 'class' =>'form-inline', 'route' => ['events.destroy', $event->id] ]) !!}
                    {{ Form::button('Delete',  ['type' => 'submit', 'class' => 'btn btn-outline-danger']) }}
                    {!! Form::close() !!}
                @endhasrole
            </div>

        </div>
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
    </script>
@stop
