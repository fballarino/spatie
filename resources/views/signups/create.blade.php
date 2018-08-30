@extends('layouts.app')
@section('title', '| Create New Booking')

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
                <p><h5>Signing up for <b>{{ $event->reference }}</b></h5></p>
            </div>
        </div>
        <hr>
        {!! Form::open(['route' => 'signups.store']) !!}
        <div class="row">
            <div class="col-4">
                <h6><b>{{ Form::label('character_id', 'Character') }}</b></h6>
                {{ Form::select('character_id', ($temp), null, ['placeholder' => 'Select...' , 'class' => 'form-control' ]) }}
            </div>
        </div>
        <div class="row">
            <div class="col-1">
                {{ Form::hidden('event_id', $event->id ) }}
                {{ Form::submit('Signup', array('class' => 'btn btn-standard')) }}
                {{ Form::close() }}
            </div>
        </div>
        {!! Form::token() !!}
        {!! Form::close() !!}
    </div>
@stop
