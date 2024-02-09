<?php

use App\DTO\Pet\Pet;

/** @var Pet[] $pets */
?>
@extends('master-table')
@section('title', 'Pet info')
@section('table-content')
    id</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">owner id</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">name</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">sex</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">date register</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">birthday</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">status</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">weight</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">edit date</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">owner home phone</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">owner email</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">type title</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">type type</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">breed</th>
    <th scope="col" class="px-6 py-3" style="text-align: center">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($pets as $pet)
        <tr>
            <th scope="row" style="text-align: center">{{ $pet->id }}</th>
            <th scope="row" style="text-align: center">{{ $pet->owner_id }}</th>
            <th scope="row" style="text-align: center">{{ $pet->alias }}</th>
            <th scope="row" style="text-align: center">{{ $pet->sex }}</th>
            <th scope="row" style="text-align: center">{{ $pet->date_register }}</th>
            <th scope="row" style="text-align: center">{{ $pet->birthday }}</th>
            <th scope="row" style="text-align: center">{{ $pet->status }}</th>
            <th scope="row" style="text-align: center">{{ $pet->weight }}</th>
            <th scope="row" style="text-align: center">{{ $pet->edit_date }}</th>
            <th scope="row" style="text-align: center">{{ $pet->owner?->home_phone ?? "" }}</th>
            <th scope="row" style="text-align: center">{{ $pet->owner?->email ?? "" }}</th>
            <th scope="row" style="text-align: center">{{ $pet->type?->title ?? "" }}</th>
            <th scope="row" style="text-align: center">{{ $pet->type?->type ?? "" }}</th>
            <th scope="row" style="text-align: center">{{ $pet->breed?->title ?? "" }}</th>
            <th scope="row" style="text-align: center">
                <p><a href="{{route('view-edit-pet-form', ['petId' => $pet->id],['breedId' => $pet->breed_id])}}"
                      type="button"
                      class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-5.5 text-center me-2 mb-2"
                      id="pet-button-edit">Edit</a></p>
                <p><a href="{{route('deletePet', ['petId' => $pet->id])}}"
                      type="button"
                      class="text-gray-900 bg-gradient-to-r from-red-200 via-red-400 to-red-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-5.5 text-center me-2 mb-2"
                      id="pet-button-delete">Delete</a></p>
            </th>
        </tr>
    @endforeach
    </tbody>
@endsection('content')
@section('footer')
    <div style="text-align: center">
        <a href="{{ route('view-new-pet-form', ['ownerId' => $pet->owner_id])}}"
           type="button"
           class="text-gray-900 bg-gradient-to-r from-blue-200 via-blue-400 to-blue-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-5.5 text-center me-2 mb-2"
           id="pet-button-add">&#129437;&#129451; Add new pet </a>
    </div>
@endsection('footer')
