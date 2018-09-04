@extends('layouts.app')
@section('title',"Update Team")
@section('content')
    <div class="container">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('teams.index')}}">Teams</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editing Team</li>
                </ol>
            </nav>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
            </div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <form action="{{route('teams.update', $team->id)}}" class="form-group" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="container">
                            <div class="row">
                                <div class="col-5">
                                    <label for="article_id" class=""><h6>Article</h6></label>
                                    <select name="article_id" class="form-control">
                                        @foreach($articles as $article)
                                            @if($team->article_id == $article->id)
                                                <option value="{{ $team->article_id }}" selected>{{ $article->description }}</option>
                                            @else
                                                <option value="{{ $article->id }}" >{{ $article->description }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5">
                                    <label for="name" class=""><h6>Name</h6></label>
                                    <input type="text" name="name" value="{{ $team->name }}" class="form-control">
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                <div class="col-2">
                                    <label for="tank" class=""><h6>Tanks</h6></label>
                                    <input type="text" name="tank" value="{{ $team->tank }}" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="healer" class=""><h6>Healers</h6></label>
                                    <input type="text" name="healer" value="{{ $team->healer }}" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="mdps" class=""><h6>Melees</h6></label>
                                    <input type="text" name="mdps" value="{{ $team->mdps }}" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="rpds" class=""><h6>Ranged</h6></label>
                                    <input type="text" name="rdps" value="{{ $team->rdps }}" class="form-control">
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                <div class="col-5">
                                    <label for="description" class=""><h6><b>Comments</b></h6></label>
                                    <textarea rows="5" cols="15" name="description"
                                              placeholder="Additional Info" class="form-control">
                                              {{ $team->description }}</textarea>
                                </div>
                                <div class="col-3 form-inline">
                                    <p></p>
                                    <button role="submit" name="submit" class="btn btn-outline-primary">Update Team</button>
                                    <form action="{{route('teams.update', $team->id)}}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button role="submit" name="submit" class="btn btn-outline-danger">Delete Team</button>
                                    </form>
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