@extends('layouts.app')
@section('title','Oblivion Articles')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="card">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Articles</li>
                        </ol>
                    </nav>
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text"></p>
                        <table class="display nowrap" id="articlesTableData">
                            <thead>
                            <tr>
                                <th>Article ID</th>
                                <th>Category</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>{{$article->id}}</td>
                                    <td>{{$article->category->description}}</td>
                                    <td>{{$article->code}}</td>
                                    <td>{{$article->description}}</td>
                                    <td>
                                        @hasrole(config('globals.executives'))
                                            <a href="{{ route('articles.edit', $article->id) }}"><i class="far fa-edit fa-lg"></i></a>
                                        @endhasrole
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @hasrole(config('globals.executives'))
                        <a href="{{ route('articles.create') }}" class="btn btn-success">Add Article</a>
                        @endhasrole
                    </div>

                </div>
                <div class="card-footer text-muted">
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
    </div>

@endsection
@section('javascript')
    @parent
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD MMM YYYY HH:mm');

            $('#articlesTableData').DataTable({
                order: [1, 'asc' ],
            });
        } );
    </script>
@stop