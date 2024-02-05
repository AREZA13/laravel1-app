<?php

use App\DTO\Pet\Pet;

/** @var Pet[] $pets */
?>
@extends('master-table')
@section('title', 'Pet info')
@section('table-content')
    id</th>
    <th scope="col" class="px-6 py-3">owner id</th>
    <th scope="col" class="px-6 py-3">type id</th>
    <th scope="col" class="px-6 py-3">name</th>
    <th scope="col" class="px-6 py-3">sex</th>
    <th scope="col" class="px-6 py-3">date register</th>
    <th scope="col" class="px-6 py-3">birthday</th>
    <th scope="col" class="px-6 py-3">breed id</th>
    <th scope="col" class="px-6 py-3">color id</th>
    <th scope="col" class="px-6 py-3">status</th>
    <th scope="col" class="px-6 py-3">weight</th>
    <th scope="col" class="px-6 py-3">edit date</th>
    <th scope="col" class="px-6 py-3">owner home phone</th>
    <th scope="col" class="px-6 py-3">owner email</th>
    <th scope="col" class="px-6 py-3">type title</th>
    <th scope="col" class="px-6 py-3">type picture</th>
    <th scope="col" class="px-6 py-3">type type</th>
    <th scope="col" class="px-6 py-3">breed</th>
    <th scope="col" class="px-6 py-3">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($pets as $pet)
        <tr>
            <th scope="row">{{ $pet->id }}</th>
            <th scope="row">{{ $pet->owner_id }}</th>
            <th scope="row">{{ $pet->type_id }}</th>
            <th scope="row">{{ $pet->alias }}</th>
            <th scope="row">{{ $pet->sex }}</th>
            <th scope="row">{{ $pet->date_register }}</th>
            <th scope="row">{{ $pet->birthday }}</th>
            <th scope="row">{{ $pet->breed_id }}</th>
            <th scope="row">{{ $pet->color_id }}</th>
            <th scope="row">{{ $pet->status }}</th>
            <th scope="row">{{ $pet->weight }}</th>
            <th scope="row">{{ $pet->edit_date }}</th>
            <th scope="row">{{ $pet->owner->home_phone }}</th>
            <th scope="row">{{ $pet->owner->email }}</th>
            <th scope="row">{{ $pet->type->title }}</th>
            <th scope="row">{{ $pet->type->picture }}</th>
            <th scope="row">{{ $pet->type->type }}</th>
            <th scope="row">{{ $pet->breed->title }}</th>
            <th scope="row" style="text-align: center">
                <p><a href=""
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
        <a href=""
           type="button"
           class="text-gray-900 bg-gradient-to-r from-blue-200 via-blue-400 to-blue-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-5.5 text-center me-2 mb-2"
           id="pet-button-add">&#129437;&#129451; Add new pet </a>
    </div>
@endsection('footer')
