@extends('layouts.app')
@section('title',"Transactions")

@section('content')
    <div class="container-fluid">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                </ol>
            </nav>
            <div class="card-body">
                <h5 class="card-title">Displaying All Transactions</h5>
                <p class="card-text"></p>
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('transactions.verify')}}" method="post">
                            {{ csrf_field() }}
                            <table class="" id="transactionsDataTable">
                                <thead class="">
                                <th>ID</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Amount IN</th>
                                <th>Amount OUT</th>
                                <th>Recipient</th>
                                <th>Issuer</th>
                                <th>DateTime</th>
                                <th>Verified</th>
                                <th>Operations</th>
                                </thead>
                                <tbody>
                                <p></p>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ substr($transaction->operation, 1, 3) }}</td>
                                        <td>{{ substr($transaction->operation, 6) }}</td>
                                        @if(($transaction->amount) > 0)
                                            <td>@money($transaction->amount, 'WOW')</td>
                                            <td></td>
                                        @else
                                            <td></td>
                                            <td>@money($transaction->amount, 'WOW')</td>
                                        @endif
                                        <td>{{ $transaction->recipient->name }}</td>
                                        <td>{{ $transaction->sender->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y H:i') }}</td>
                                        <td>
                                            <input type="checkbox" name="{{$transaction->id}}"
                                                    {{($transaction->verified)? "disabled checked" : ""}}>
                                            {{$transaction->verified_by}}
                                        </td>
                                        <td>
                                            @hasrole(config('globals.accountants'))
                                            <a href="{{ route('transactions.show', $transaction->id) }}"><i class="far fa-arrow-alt-circle-right fa-lg"></i></a>
                                            <a href="{{ route('transactions.edit', $transaction->id) }}"><i class="far fa-edit fa-lg"></i></a>
                                            @endhasrole
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td>
                                        @hasrole(config('globals.accountants'))
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-check-square"></i> Verify</button>
                                        @endhasrole
                                    </td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                </div>
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
                order: [ 7, 'desc' ],
                "LengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
                "pageLength": 25
            });
        } );
    </script>
@stop