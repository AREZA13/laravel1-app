<?php

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
    return view('login-page');
})->name('show-login-page');

Route::get('/registration', function () {
    return view('registration-page');
})->name('show-registration-page');

Route::get('/client', [\App\Http\Controllers\ClientController::class, 'getAll'])->name('client');
Route::get('/client/{clientId}', [\App\Http\Controllers\PetController::class, 'getPetsByClientId'])->name('clientPetList');
Route::post('/registration', [\App\Http\Controllers\UserController::class, 'storeUserRegistration'])->name('storeform');
