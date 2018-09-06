@extends('layouts.app')
@section('title',"Edit Transaction")

@section('content')
    <div class="container">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('transactions.index')}}">Transactions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editing Transaction</li>
                </ol>
            </nav>
                <div class="card-body">
                    <h5 class="card-title">Editing Transaction # {{$transaction->id}}</h5>

                    <p class="card-text"></p>
                        <form action="{{route('transactions.update', $transaction->id)}}" class="form-group" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="container">
                                <div class="form-row">
                                    <div class="form-group col-5">
                                        <label for="code" class=""><h6>Movement</h6></label>
                                        <select name="code" class="form-control">
                                            @foreach(config('globals.operationsTransaction') as $key => $value)
                                                @if($transaction->operation == $value )
                                                    <option value="{{ $key }}" selected>{{ $value }}</option>
                                                @else
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-5">
                                        <label for="user_id" class=""><h6>Recipient</h6></label>
                                        <select name="user_id" class="form-control">
                                            @foreach($userlist as $user)
                                                @if($transaction->user_id == $user->id)
                                                    <option value="{{ $transaction->user_id }}" selected>{{ $user->name }}</option>
                                                @else
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-3">
                                        <label for="amount" class=""><h6>Amount</h6></label>
                                    <input type="text" name="amount" value="{{ $transaction->amount }}" class="form-control">
                                    </div>
                                </div>
                                <p></p>
                                <div class="form-row">
                                    <div class="form-group col-5">
                                        <label for="note" class=""><h6>Comments</h6></label>
                                        <textarea rows="4" cols="10" name="note" placeholder="Optional comments"
                                                  class="form-control">{{ $transaction->note }}</textarea>
                                    </div>
                                    <div class="form-group form-inline col-3">
                                    <p></p>
                                        <button role="submit" name="submit" class="btn btn-primary">Update</button>
                                    </div>
                                    <div class="form-group col-3">
                                        <div class="card" style="width: 18rem;">
                                            <div class="card-header">
                                                Instructions
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Select Oblivion Community for all movements apart from Booster Payment,
                                                    where you have to select the recipient of the amount</li>
                                                <li class="list-group-item">Input negative amount for gold outbound, positive for inbound</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                    </form>
                </div>
                <button onclick="goBack()" class="btn btn-primary">Back</button><p></p>
            <div class="card-footer text-muted">
                @if($transaction->verified)
                    <p class="text-info">Transaction verified by <b>{{ $transaction->verified_by }}</b> on
                        <b>{{ \Carbon\Carbon::parse($transaction->verified_at)->format('d M Y H:i') }}</b></p>
                @endif
            </div>
        </div>
    </div>
@stop
@section('javascript')
    @parent
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@stop