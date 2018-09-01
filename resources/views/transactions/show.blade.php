@extends('layouts.app')
@section('title',"Banks Management")
<?php
use Akaunting\Money\Currency;
use Akaunting\Money\Money;
?>
@section('css')
    <link href="{{ url('/css/banks.css') }}" rel="stylesheet">
@stop
@section('content')
    <div class="container">
        @component('components.accountant')
        @endcomponent
        <div class="row">

            <div class="col-10 border bg-primary text-white">
                <h5 class="mt-2">Displaying Transaction: {{ $transaction->id }}
                </h5>
            </div>
            <div class="col-1"></div>
        </div>
            <p></p>
        <div class="row">
            <div class="col-1"></div>
            <form class="">
                <div class="form-group mb-3">
                    <label for="operator" class=""><h6>Operator</h6></label>
                    <input type="text" disabled name="operator" value="{{ $operator->name }}" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="created_at" class=""><h6>Issued</h6></label>
                    <input type="text" disabled name="operator" value="{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y H:i') }}" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="operator" class=""><h6>Amount</h6></label>
                    <input type="text" disabled name="amount" value="{{ abs($transaction->amount) }}" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="operator" class=""><h6>Note</h6></label>
                    <textarea type="text" rows="4" cols="15" disabled name="amount" class="form-control">{{ $transaction->note }}</textarea>
                </div>
            </form>
            <div class="col-1"></div>
        </div>
    </div>
@stop
@section('javascript')
    @parent

@stop