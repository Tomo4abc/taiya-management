@extends('layouts.app')

@section('content')

    <table border="1" style="text-align:center">
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>種別</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
         @foreach ($item as $item)
            <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->type }}</td>
            <td>{{ $item->detail }}</td>
            </tr>
         @endforeach
        </tbody>
    </table>

@endsection