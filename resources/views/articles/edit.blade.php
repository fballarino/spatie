@extends('layouts.app')
@section('title',"New Article")
@section('content')
<div class="container">
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Article</li>
            </ol>
        </nav>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text"></p>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{route('articles.update', $article->id)}}" class="form-group" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PATCH')}}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3">
                                <label for="category_id" class=""><h6>Category</h6></label>
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $key => $value)
                                        @if($article->category_id == $key)
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5">
                                <label for="description" class=""><h6>Description</h6></label>
                                <input type="text" name="description" value="{{ $article->description }}" class="form-control">
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-3">
                                <label for="code" class=""><h6>Code</h6></label>
                                <input type="text" name="code" value="{{ $article->code }}" class="form-control">
                            </div>
                            <div class="col-5">
                                <label for="note" class=""><h6>Comments</h6></label>
                                <textarea rows="6" cols="80" name="note"
                                          placeholder="Optional comments" class="form-control">
                                    {{ $article->note }}</textarea>
                            </div>
                            <div class="col-3 form-inline">
                                <p></p>
                                <button role="submit" name="submit" class="btn btn-outline-primary">
                                    <i class="far fa-edit"></i> Update</button>&nbsp;
                </form>
                                <form action="{{route('articles.destroy', $article->id)}}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-minus-circle"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
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