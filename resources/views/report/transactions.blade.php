@extends('default')
@section('content')
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Month</th>
                <th scope="col">Sum</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>
                        @switch($transaction->month)
                            @case(1)
                            Jan
                            @break

                            @case(2)
                            Feb
                            @break

                            @case(3)
                            Mar
                            @break

                            @case(4)
                            Apr
                            @break

                            @case(5)
                            May
                            @break

                            @case(6)
                            Jun
                            @break

                            @case(7)
                            Jul
                            @break

                            @case(8)
                            Aug
                            @break

                            @case(9)
                            Sep
                            @break

                            @case(10)
                            Oct
                            @break

                            @case(11)
                            Nov
                            @break

                            @case(12)
                            Dec
                            @break

                        @endswitch
                        </td>
                    <td>{{ $transaction->sum }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop