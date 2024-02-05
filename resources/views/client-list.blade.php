<?php

use App\DTO\Client;

/** @var Client[] $clients */
?>
@extends('master-table')
@section('title', 'Client Table')
@section('table-content')
    ID</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">ФИО</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">
        <form action="{{ route('searchByFIO') }}" method="GET" class="flex items-center">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
                    </svg>
                </div>
                <input type="text" name="lastname"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-20.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Search by lastname..." required>
            </div>
            <button type="submit"
                    class="p-20.5 ms-2 text-sm font-medium text-white bg-lime-200 rounded-lg border border-gray-300 hover:bg-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:bg-lime-200 dark:hover:bg-lime-200 dark:focus:ring-lime-200">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 20 20">
                    <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </form>
    </th>
    </tr>
    </thead>
    @if(!empty($searchInfoMessage))
        <div class="p-0 mb-0 text-center text-sm text-yellow-800  bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
             role="alert">
            <span class="font-medium">{{$searchInfoMessage}}</span>
        </div>
    @endif
    <tbody>
    @foreach ($clients as $client)
        <tr>
            <th scope="row">{{ $client->id }}</th>
            <td style="text-align: center">{{ $client->getFullName()}}</td>
            <td style="text-align: center"><a href="{{ route('clientPetList', ['clientId' => $client->id]) }}"
                                              type="button"
                                              class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-3 py-5.5 text-center me-2 mb-2"
                                              id="pet-button">Pet</a></td>
        </tr>
    @endforeach
    </tbody>
@endsection
