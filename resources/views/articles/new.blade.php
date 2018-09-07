@extends('layouts.app')
@section('title',"New Article")
@section('content')
    <div class="container">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Article</li>
                </ol>
            </nav>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{route('articles.store')}}" class="form-group" method="post">
                        {{ csrf_field() }}
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-3">
                                    <label for="category_id" class=""><h6>Category</h6></label>
                                    <select name="category_id" class="form-control">
                                        <option value="" selected>Select...</option>
                                        @foreach($categories as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5">
                                    <label for="description" class=""><h6>Description</h6></label>
                                    <input type="text" name="description" class="form-control">
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                <div class="col-3">
                                    <label for="code" class=""><h6>Code</h6></label>
                                    <input type="text" name="code"  class="form-control">
                                </div>
                                <div class="col-5">
                                    <label for="note" class=""><h6>Comments</h6></label>
                                    <textarea rows="6" cols="80" name="note"
                                              placeholder="Optional comments" class="form-control"></textarea>
                                </div>
                                <div class="col-3 form-inline">
                                    <p></p>
                                    <button role="submit" name="submit" class="btn btn-outline-primary"><i class="far fa-plus-square"></i> Create</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer text-muted">
                {{ \Illuminate\Support\Facades\Auth::user()->name }}
            </div>
        </div>
    </div>
@stop
@section('javascript')
    @parent
@stop