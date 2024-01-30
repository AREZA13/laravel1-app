<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('welcome');
});

Route::get('/client', [\App\Http\Controllers\ClientController::class, 'getAll'])->name('client');
Route::get('/client/{clientId}', [\App\Http\Controllers\PetController::class, 'getPetsByClientId'])->name('clientPetList');
