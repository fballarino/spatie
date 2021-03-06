@extends('layouts.app')
@section('title',"Goldtrack Management")

@section('content')
    <div class="container">
        <div class="card">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('goldtracks.index')}}">Goldtrack</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <hr>
                    </div>
                    <div class="col-2"></div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <form action="{{ route('goldtracks.update', $goldtrack->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-row">
                                <div class="form-group col-md-1">
                                    <label for="booking_id" class=""><h6>ID</h6></label>
                                    <input type="text" name="booking_id" disabled value="{{ $goldtrack->id }}" class="form-control w-75">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="amount" class=""><h6>Amount</h6></label>
                                    <input type="text" name="amount" value="{{ $goldtrack->amount }}" class="form-control">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="recipient" class=""><h6>Collector</h6></label>
                                    <select name="user_id" class="form-control">
                                        @foreach($userlist as $user)
                                            @if($goldtrack->user_id == $user->id)
                                                <option value="{{ $goldtrack->user_id }}" selected>{{ $user->name }}</option>
                                            @else
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-1">
                                    <label for="code" class=""><h6>Code</h6></label>
                                    <input type="text" name="code" value="{{ $goldtrack->code }}" class="form-control w-75">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="verified" class=""><h6>Verified</h6></label>
                                    <input type="checkbox" name="verified" {{ ($goldtrack->verified)? "checked" : "" }}
                                    class="form-check-inline w-50" style="width: 40px; height: 40px">
                                </div>
                                <div class="form-group form-inline col-md-2">
                                    <button type="submit" class="btn btn-outline-primary"><i class="fas fa-pen-alt"></i> Update</button>
                                </div>
                        </form>
                        <div class="form-group form-inline col-md-2">
                            <form action="{{ route('goldtracks.destroy', $goldtrack->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>

            </div>
            <div class="card-footer text-muted">
                {{ \Illuminate\Support\Facades\Auth::user()->name }}
            </div>
        </div>
        </div>
    </div>

@stop
