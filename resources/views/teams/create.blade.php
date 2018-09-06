@extends('layouts.app')
@section('title',"New Team")
@section('content')
    <div class="container">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('teams.index')}}">Teams</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Team</li>
                </ol>
            </nav>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
            </div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <form action="{{route('teams.store')}}" class="form-group" method="post">
                        {{ csrf_field() }}
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <label for="article_id" class=""><h6>Article</h6></label>
                                    <select name="article_id" class="form-control">
                                        <option value="" selected>Select...</option>
                                        @foreach($articles as $article)
                                            <option value="{{ $article->id }}" >{{ $article->code }}-{{ $article->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                <div class="col-2">
                                    <label for="name1" class=""><h6>Name</h6></label>
                                    <input type="text" name="name1" readonly value="Team" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="name1" class=""><h6>&nbsp;</h6></label>
                                    <select name="name2" class="form-control">
                                        <option value="" selected>Select...</option>
                                        @foreach(config('globals.colors') as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="name1" class=""><h6>&nbsp;</h6></label>
                                    <select name="name3" class="form-control">
                                        <option value="" selected>Select...</option>
                                        @foreach(config('globals.days') as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label for="name1" class=""><h6>&nbsp;</h6></label>
                                    <select name="name4" class="form-control">
                                        <option value="" selected>Select...</option>
                                        @foreach(config('globals.hours') as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label for="name1" class=""><h6>&nbsp;</h6></label>
                                    <select name="name5" class="form-control">
                                        <option value="" selected>Select...</option>
                                        @foreach(config('globals.minutes') as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                <div class="col-2">
                                    <label for="tank" class=""><h6>Tanks</h6></label>
                                    <input type="text" name="tank" value="{{ old('tank') }}" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="healer" class=""><h6>Healers</h6></label>
                                    <input type="text" name="healer" value="{{ old('healer') }}" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="mdps" class=""><h6>Melees</h6></label>
                                    <input type="text" name="mdps" value="{{ old('mdps') }}" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="rpds" class=""><h6>Ranged</h6></label>
                                    <input type="text" name="rdps" value="{{ old('rdps') }}" class="form-control">
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                <div class="col-5">
                                    <label for="description" class=""><h6>Comments</h6></label>
                                    <textarea rows="5" cols="15" name="description"
                                              placeholder="Additional Info" class="form-control">
                                              {{ old('description') }}</textarea>
                                </div>
                                <div class="col-3 form-inline">
                                    <p></p>
                                    <button role="submit" name="submit" class="btn btn-outline-primary">Create Team</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="card-footer text-muted">
                {{ \Illuminate\Support\Facades\Auth::user()->name }}
            </div>
        </div>
    </div>
@stop
@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD MMM YYYY HH:mm');

        });
    </script>
@stop