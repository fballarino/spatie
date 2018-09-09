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
                    <div class="col-2 form-group">
                        <label for="article_id"><h6>Faction</h6></label>
                        <select id="" name="faction_id" class="form-control">
                            <option value="">Select...</option>
                            <option value="1">Horde</option>
                            <option value="2">Alliance</option>
                        </select>
                    </div>
                    <div class="col-4 form-group">
                        <label for="article_id"><h6>Product</h6></label>
                        <select id="" name="article_id" class="form-control">
                            <option value="">Select...</option>
                            @foreach($articles as $article)
                                <option value="{{$article->id}}">{{$article->description}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2 form-group">
                        <label for="buyers"><h6>Buyers Slots</h6></label>
                        <input name="buyers" id="buyers" value="{{old('buyers')}}" class="form-control" />
                    </div>
                    <div class="col-2 form-group">
                        <label for="boosters"><h6>Boosters Slots</h6></label>
                        <input name="boosters" id="boosters" value="{{old('boosters')}}"class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 form-group">
                        <label for="run_at"><h6>Event Date</h6></label>
                        <input name="run_at" id="input" value="{{old('run_at')}}" class="form-control" />
                    </div>
                    <div class="col-3 form-group">
                        <label for="visible_at"><h6>Show Event on</h6></label>
                        <input name="visible_at" id="input2" class="form-control"
                               value="{{(old('buyers'))? old('buyers') :
                               \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('H:i m/d/Y')}}"/>
                        <small>entering current time by default</small>
                    </div>
                    <div class="col-2 form-group">
                        <label for="overbooking"><h6>Overbooking</h6></label>
                        <select name="overbooking" value="{{old('overbooking')}}"class="form-control">
                            <option value="0" selected>No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-2 form-group">
                        <label for="leader_cut"><h6>Leader Cut</h6></label>
                        <input name="leader_cut" id="input2" value="{{old('leader_cut')}}"class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <label for="note"><h6>Info</h6></label>
                        <textarea rows="6" cols="80" name="note" id="note" class="form-control"
                                  placeholder="Notes...">{{old('note')}}</textarea>
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
        $('#input2').datetimepicker({
            footer: true,
            modal: true });
    </script>
@stop
