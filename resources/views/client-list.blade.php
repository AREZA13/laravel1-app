<?php

use App\DTO\Client;

/** @var Client[] $clients */
?>
@extends('master-table')
@section('title', 'Client Table')
@section('table-content')
    ID</th>
    <th scope="col" class="px-6 py-3">ФИО</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($clients as $client)
        <tr>
            <th scope="row">{{ $client->id }}</th>
            <td>{{ $client->getFullName()}}</td>
            <td><a href="{{ route('clientPetList', ['clientId' => $client->id]) }}" type="button"
                   class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-3 py-5.5 text-center me-2 mb-2"
                   id="pet-button">Pet</a></td>
        </tr>
    @endforeach
    </tbody>
@endsection
