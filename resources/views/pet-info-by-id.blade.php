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
        </tr>
    @endforeach
    </tbody>
@endsection('content')
