@extends('layouts.app')
@section('title',"Oblivion Pricelist")
@section('css')
    <link href="{{ url('/css/banks.css') }}" rel="stylesheet">
@stop

@section('content')
@component('components.pricing-card')
    @section('all', "Price List")
    @section('item_one', "Dungeons")
    @section('item_two', "Raids & Expeditions")
    @section('item_three', "Glory & Achievements")

    @section('table')
        <div class="card w-75">
            <div class="card-body">
                <h5 class="card-title">Raids</h5>
                <p class="card-text">
                    <table class="table">
                        <thead class="thead-light">
                            <th scope="col">Event</th>
                            <th scope="col">Price</th>
                            <th scope="col">Valid to</th>
                        </thead>
                        <tbody>
                            @foreach($pricelist as $item)
                                @if($item->article->category_id == 2)
                                    <tr>
                                        <td>{{$item->article->description}}</td>
                                        <td>@money($item->price,"WOW")</td>
                                        <td>{{\Carbon\Carbon::parse($item->valid_to)->format('d M Y H:i')}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </p>
            </div>
        </div>
    @stop
@endcomponent
@stop
