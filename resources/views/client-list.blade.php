@extends('master')
@section('title', 'Client Table')
@section('content')
<table>
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">ФИО</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($clients as $client)
        <tr>
            <th scope="row">{{ $client->id }}</th>
            <td>{{ $client->getFullName()}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
