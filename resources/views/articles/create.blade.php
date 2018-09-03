@extends('layouts.app')
@section('title',"Oblivion Pricelist")
@section('css')
    <link href="{{ url('/css/banks.css') }}" rel="stylesheet">
@stop

@section('content')
    @component('components.pricing-card-create')
        @section('argument', "Creating a new entry for Pricelist")
        @section('form')
            <form action="{{route('pricelists.store')}}" method="post">
                {{csrf_field()}}
                {{method_field('POST')}}
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="article_id">Article</label>
                        <select name="article_id" id="" class="form-control">
                            <option value="" selected>Select...</option>
                            @foreach($articles as $article)
                                <option value="{{$article->id}}">{{$article->code}} / {{$article->description}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="price">Price</label>
                        <input type="price" name="price" class="form-control" id="price">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="is_active">Active</label>
                        <select name="is_active" id="" class="form-control">
                            <option value="" selected>Select...</option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                </div>
                <!-- / first row-->
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="valid_from">Valid from</label>
                        <input type="text" name="valid_from" class="form-control" id="inputvalid_from"
                        value="{{\Carbon\Carbon::now()->format('H:i m/d/Y')}}">
                        <small>by default set to now</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="valid_to">Valid to</label>
                        <input type="text" name="valid_to" class="form-control" id="inputvalid_to"
                               value="{{\Carbon\Carbon::now()->format('H:i m/d/Y')}}">
                    </div>
                </div>
                <!-- / second row row-->
                <button type="submit" class="btn btn-primary"><i class="fab fa-creative-commons-share"></i> Create</button>
            </form>
        @stop
    @endcomponent
@stop
@section('javascript')
    @parent
    <script>
        $('#inputvalid_from').datetimepicker({
            footer: true,
            modal: true,
        });
        $('#inputvalid_to').datetimepicker({
            footer: true,
            modal: true });
    </script>
@stop