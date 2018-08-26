@extends('layouts.app')

@section('title', '| Create New Product')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h1>Edit Product</h1>
            <hr>

            {{-- Using the Laravel HTML Form Collective to create our form --}}
            {{ Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT')) }}

            <div class="form-group">
                {{ Form::label('item', 'Item') }}
                {{ Form::text('item', null, array('class' => 'form-control')) }}
                <br>

                {{ Form::label('difficulty', 'Difficulty') }}
                {{ Form::select('difficulty', [
                                'Normal' => 'Normal',
                                'Heroic' => 'Heroic',
                                'Mythic' => 'Mythic',
                                '10'     => '10',
                                '11'     => '11',
                                '12'     => '12',
                                '13'     => '13',
                                '14'     => '14',
                                '15'     => '15',
                                 ], null, ['placeholder' => 'Choose difficulty...']) }}
                <br>
                <br>
                {{ Form::label('buyers', 'Default # Buyers') }}
                {{ Form::text('buyers', null, array('class' => 'form-control')) }}

                {{ Form::label('boosters', 'Default # Boosters') }}
                {{ Form::text('boosters', null, array('class' => 'form-control')) }}

                <br>

                {{ Form::label('overbooking', 'Overbooking') }}
                {{ Form::select('overbooking', [
                                0 => 'No',
                                1 => 'Yes',
                                ], null, ['placeholder' => 'Overbooking...'])}}
                <br>
            </div>

                {{ Form::submit('Edit Product', array('class' => 'btn btn-success btn-sm btn-block')) }}
                {{ Form::close() }}
        </div>
    </div>

@endsection