<?php

use App\DTO\Pet\Pet;

/** @var Pet[] $pets */
?>
@extends('master')
@section('title', 'Add pet')

<form action="{{ route('store-pet') }}" method="POST" class="max-w-sm mx-auto">
    <form class="max-w-sm mx-auto">
        @csrf
        <p id="helper-text-explanation" class="mt-2 p-8 text-lg text-gray-500 dark:text-gray-500 font-large  "
           style="text-align: center">Add info for new pet.</p>

        <label for="alias" class="block mb-2 text-sm font-medium text-gray-900"></label>
        <input type="text" id="alias" name="alias" aria-describedby="helper-text-explanation"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="Alias">

        <label for="typeId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-500">Select type</label>
        <select id="typeId"
                name="type_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">

            {{--        <option value="3" hidden="hidden"></option>--}}
        </select>

        <label for="breedId" class="c text-sm font-medium text-gray-900 dark:text-gray-500">Select breed</label>
        <select id="breedId"
                name="breed_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                disabled="disabled"
        >
            {{--        <option>United States</option>--}}
        </select>

        <label for="ownerId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Owner Id</label>
        <input value="{{$ownerId}}" id="ownerId" type="hidden" name="owner_id"
               aria-describedby="helper-text-explanation"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="name@flowbite.com">
        <div style="text-align: center">
            <button type="submit" style="text-align: center"
                    class="text-gray-900 bg-gradient-to-r from-blue-200 via-blue-400 to-blue-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-5.5 text-center me-2 mb-2"
                    id="pet-button-add">&#129437;&#129451; Add new pet
            </button>
        </div>
    </form>

    <script>
        {{--    Functions --}}
        async function fillPEtTypesIntoSelectOption() {
            const responseWithTypes = await fetch("/petType", {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                }
            });

            const decodedJson = await responseWithTypes.json();
            decodedJson.forEach((type) => {
                insertIntoOptionType(type)
            });
        }

        function insertIntoBreedType(breed) {
            document.getElementById("breedId").removeAttribute("disabled")
            let row = `<option value="${breed.id}">${breed.title}</option>`
            document.getElementById("breedId").innerHTML += row;

        }

        function insertIntoOptionType(type) {

            let row = `<option value="${type.id}">${type.title}</option>`
            document.getElementById("typeId").innerHTML += row;
        }

        async function getBreedByTypeId(target) {
            let typeIdNumber = target.target.value;
            const response = await fetch(`/breed/${typeIdNumber}`, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            });

            const decodedJson = await response.json();

            document.getElementById("breedId").innerHTML = "";

            decodedJson.forEach((breed) => {
                insertIntoBreedType(breed)
            });
        }

        document.getElementById("typeId").onclick = getBreedByTypeId;

        {{--    Actions --}}
        document.addEventListener("DOMContentLoaded", fillPEtTypesIntoSelectOption);


    </script>
