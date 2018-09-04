@extends('layouts.app')
@section('title',"New Transaction")
@section('content')
<div class="container">
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('banks.index')}}">Banks</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Transaction</li>
            </ol>
        </nav>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text"></p>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <form action="{{route('transactions.store')}}" class="form-group" method="post">{{ csrf_field() }}
                    <div class="container">
                        <div class="row">
                            <div class="col-5">
                                <label for="code" class=""><h6><b>Movement</b></h6></label>
                                <select name="code" class="form-control">
                                        <option value="" selected>Select...</option>
                                    @foreach(config('globals.operationsTransaction') as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5">
                                <label for="recipient" class=""><h6><b>Recipient</b></h6></label>
                                <select name="recipient" class="form-control">
                                    <option value="999" selected>Select if needed...</option>
                                    @foreach($userlist as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-3">
                                <label for="amount" class=""><h6><b>Amount</b></h6></label>
                                <input type="text" name="amount" value="0" class="form-control">
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-5">
                                <label for="note" class=""><h6><b>Comments</b></h6></label>
                                <textarea rows="4" cols="10" name="note" placeholder="Optional comments" class="form-control"></textarea>
                            </div>
                            <div class="col-3">
                                <p></p>
                                <input type="hidden" name="bank" value="{{$id}}">
                                <button role="submit" name="submit" class="btn btn-info">Create</button>
                            </div>
                            <div class="col-3">
                                <p>*Movement must be selected</p>
                                <p>*Recipient must be selected only if it is a Booster</p>
                                <p>*Input negative amount for gold outbound, positive for inbound</p>
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

                    $('#transactionsDataTable').DataTable({
                        order: [ 6, 'desc' ],
                        "LengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
                        "pageLength": 25
                    });
                } );
            </script>
@stop