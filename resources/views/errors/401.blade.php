@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class="card text-center">
            <div class="card-header">
                Warning!
            </div>
            <div class="card-body">
                <h5 class="card-title">401 - Lacking Authorization</h5>
                <p class="card-text">You are not entitled to view this page</p>
                <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Dashboard</a>
            </div>
            <div class="card-footer text-muted">
                Oblivion Boost
            </div>
        </div>
    </div>
@endsection