@extends('default')
@section('content')
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Group</th>
                <th scope="col">Sum</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sums as $item)
                <tr>
                    <td>
                        @switch($item->group)
                            @case(1)
                            From 18 to 25
                            @break

                            @case(2)
                            From 25 to 50
                            @break

                            @case(3)
                            Over 50
                            @break

                        @endswitch
                        </td>
                    <td>{{ $item->value }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop