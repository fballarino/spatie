@extends('layouts.app')
@section('title', 'New Bank')

@section('content')
    <div class="container">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('banks.index')}}">Banks</a></li>
                    <li class="breadcrumb-item active" aria-current="page">New Bank</li>
                </ol>
            </nav>

            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <form action="{{ route('banks.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-3 form-group">
                            <label for="realm"><h6>Realm *</h6></label>
                            <input name="realm" value="{{old('realm')}}" id="" class="form-control" />
                        </div>
                        <div class="col-2 form-group">
                            <label for="balance"><h6>Balance</h6></label>
                            <input name="balance" value="{{old('balance')}}" id="" class="form-control" />
                            <small id="emailHelp" class="form-text text-muted">Initial balance if present</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 form-group">
                            <label for="faction"><h6>Faction*</h6></label>
                            <select name="faction" class="form-control">
                                <option value="" selected>Select Faction</option>
                                <option value="H"selected>Horde</option>
                                <option value="A">Alliance</option>
                            </select>
                        </div>
                        <div class="col-3 form-group">
                            <label for="region"><h6>Region*</h6></label>
                            <select name="region" class="form-control">
                                <option value="" selected>Select Region</option>
                                <option value="DE">German Realm</option>
                                <option value="EN">English Realm</option>
                                <option value="ES">Spanish Realm</option>
                                <option value="EN">English Realm</option>
                                <option value="FR">French Realm</option>
                                <option value="IT">Italian Realm</option>
                                <option value="RU">Russian Realm</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 form-group">
                            <button type="submit" class="btn btn-primary"><i class="fab fa-creative-commons-share"></i> Create</button>
                        </div>
                        <div class="col-3 form-group">
                            <div class="card">
                                <div class="card-header">
                                    Instructions
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li>Realm, Faction and Region are mandatory</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
    </script>
@stop