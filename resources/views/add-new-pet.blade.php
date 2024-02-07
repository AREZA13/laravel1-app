<?php

use App\DTO\Pet\Pet;

/** @var Pet[] $pets */
?>
@extends('master')
@section('title', 'Add pet')


<form class="max-w-sm mx-auto">
    <p id="helper-text-explanation" class="mt-2 p-8 text-lg text-gray-500 dark:text-gray-500 font-large  "
       style="text-align: center">Add info for new pet.</p>

    <label for="alias" class="block mb-2 text-sm font-medium text-gray-900"></label>
    <input type="text" id="alias" aria-describedby="helper-text-explanation"
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           placeholder="Alias">

    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-500">Select type</label>
    <select id="type"
            name="type"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">

        <option value="3">United States</option>
        <option>Canada</option>
    </select>

    <label for="breed" class="c text-sm font-medium text-gray-900 dark:text-gray-500">Select breed</label>
    <select id="breed"
            disabled="disabled"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option>United States</option>
        <option>Canada</option>
    </select>

    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Owner Id</label>
    <input type="hidden" id="email" aria-describedby="helper-text-explanation"
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           placeholder="name@flowbite.com">
</form>
<div style="text-align: center">
    <a href=""
       type="button"
       class="text-gray-900 bg-gradient-to-r from-blue-200 via-blue-400 to-blue-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-5.5 text-center me-2 mb-2"
       id="pet-button-add">&#129437;&#129451; Add new pet </a>
</div>

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

    function insertIntoOptionType(type) {

        let row = `<option value="${type.id}">${type.title}</option>`
        document.getElementById("type").innerHTML += row;
    }

    {{--    Actions --}}
    document.addEventListener("DOMContentLoaded", fillPEtTypesIntoSelectOption);
</script>
