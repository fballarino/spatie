@extends('layouts.app')
@section('content')
<div class="container">
        <table class="table table-bordered table-striped" id="dataProducts">
            <thead>
            <tr>
                <th>Item</th>
                <th>Difficulty</th>
                <th>Last Update</th>
                <th>Def. Buyers</th>
                <th>Def. Boosters</th>
                <th>Overbooking</th>
                <th colspan="2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->item }}</td>
                    <td>{{ $item->difficulty }}</td>
                    <td>{{ ($item->updated_at)? $item->updated_at->format('d M Y H:i') : "" }}</td>
                    <td>{{ $item->buyers }}</td>
                    <td>{{ $item->boosters }}</td>
                    <td>{{ ($item->overbooking)? "Yes" : "No" }}</td>
                    <td>
                        <a href="{{ route('products.edit', $item->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;"> <i class="fas fa-edit fa-1x"></i> Update</a></td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $item->id] ]) !!}
                    <td>
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    <br><a href="{{ route('products.create') }}" class="btn btn-success">Add Product</a></br>
</div>
@endsection
@section('javascript')
    @parent
    <script>
        $(document).ready( function () {
            $('#dataProducts').dataTable();
            $('div.alert').fadeIn(3000);
        } );
    </script>
@stop