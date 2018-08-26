@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Admin Dashboard for <b>{{ Auth::user()->name }}</b></h4>
    <div class="row">
        <div class="col-4 border">
            <p></p>
            <ul class="list-group-flush">
                <li class="list-group-item-">
                    <a href="{{ route('users.index') }}" class="btn-link"><i class="fas fa-users fa-2x"></i> Users</a></li>
                <li class="list-group-item-">
                    <a href="{{ route('roles.index') }}" class="btn-link"><i class="fab fa-r-project fa-2x"></i> Role</a></li>
                <li class="list-group-item-">
                    <a href="{{ route('permissions.index') }}" class="btn-link"><i class="fas fa-drum-steelpan fa-2x"></i>  Permissions</a></li>
                <li class="list-group-item-">
                    <a href="{{ route('products.index') }}" class="btn-link"><i class="fab fa-product-hunt fa-2x"></i>  Products</a></li>
                <li class="list-group-item-">
                    <a href="{{ route('events.index') }}" class="btn-link"><i class="fab fa-elementor fa-2x"></i>   Events</a></li>
            </ul>
        </div>
        <div class="col-12">
        </div>
        <div class="col-8">
        </div>
        <div class="col-4 border">
            Last Logged in: ...
        </div>
    </div>
</div>
@stop
@section('javascript')
    @parent
@stop