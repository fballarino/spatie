@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Dashboard for <b>{{ Auth::user()->name }}</b></h4>
    <div class="row">
        <div class="col-4 border">
            <p></p>
                @hasrole(config('globals.managers'))
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('users.index') }}" class="btn-link">Users</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <i class="fab fa-r-project fa-2x"></i>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('roles.index') }}" class="btn-link">Role</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-drum-steelpan fa-2x"></i>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('permissions.index') }}" class="btn-link">Permissions</a>
                        </div>
                    </div>
                @endhasrole
                @hasrole(config('globals.accountants'))
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-file-invoice-dollar fa-2x"></i>
                        </div>
                            <div class="col-3">
                            <a href="{{ route('banks.index') }}" class="btn-link">Banks</a>
                        </div>
                    </div>
                @endhasrole
                    <div class="row">
                        <div class="col-2">
                            <i class="fab fa-product-hunt fa-2x"></i>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('characters.index') }}" class="btn-link">Characters</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <i class="fab fa-elementor fa-2x"></i>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('events.index') }}" class="btn-link">Events</a>
                        </div>
                    </div>
        </div>
        <div class="col-8">

        </div>
        <div class="col-8 border">
            Morbi a posuere magna. Etiam dolor risus, ultricies nec odio vitae, placerat aliquet quam. Vivamus eget nisl ut sapien finibus vestibulum. Praesent nec tellus elit. Mauris tellus lectus, consequat vel ligula in, egestas scelerisque mauris. Aliquam in mauris sed est consequat aliquet tempus sed dolor. In sodales, est vel tincidunt.
        </div>
        <div class="col-4 border-danger">
            Morbi a posuere magna. Etiam dolor risus, ultricies nec odio vitae, placerat aliquet quam. Vivamus eget nisl ut sapien finibus vestibulum. Praesent nec tellus elit. Mauris tellus lectus, consequat vel ligula in, egestas scelerisque mauris. Aliquam in mauris sed est consequat aliquet tempus sed dolor. In sodales, est vel tincidunt.
        </div>

        <div class="col-8">
            Morbi a posuere magna. Etiam dolor risus, ultricies nec odio vitae, placerat aliquet quam. Vivamus eget nisl ut sapien finibus vestibulum. Praesent nec tellus elit. Mauris tellus lectus, consequat vel ligula in, egestas scelerisque mauris. Aliquam in mauris sed est consequat aliquet tempus sed dolor. In sodales, est vel tincidunt.
        </div>
        <div class="col-4 border">
            Morbi a posuere magna. Etiam dolor risus, ultricies nec odio vitae, placerat aliquet quam. Vivamus eget nisl ut sapien finibus vestibulum. Praesent nec tellus elit. Mauris tellus lectus, consequat vel ligula in, egestas scelerisque mauris. Aliquam in mauris sed est consequat aliquet tempus sed dolor. In sodales, est vel tincidunt.
        </div>
    </div>
</div>
@stop
@section('javascript')
    @parent
@stop