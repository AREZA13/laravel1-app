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

Route::get('/login', function () {
    return view('login-page');
})->name('login');

Route::get('/registration', function () {
    return view('registration-page');
})->name('show-registration-page');

Route::post('/registration', [\App\Http\Controllers\UserController::class, 'storeUserRegistration'])->name('storeform');
Route::post('/login', [\App\Http\Controllers\UserController::class, 'checkFromLoginForm'])->name('loginform');

Route::get('/client', [\App\Http\Controllers\ClientController::class, 'getAllLimit50'])
    ->middleware('auth.basic')
    ->name('client');
Route::get('/searchByFIO', [\App\Http\Controllers\ClientController::class, 'searchClientsByFIOLim50'])
    ->middleware('auth.basic')
    ->name('searchByFIO');
Route::get('/client/{clientId}', [\App\Http\Controllers\PetController::class, 'getPetsByClientId'])
    ->middleware('auth.basic')
    ->name('clientPetList');
Route::get('/petDelete/{petId}', [\App\Http\Controllers\PetController::class, 'deletePetWithButton'])
    ->middleware('auth.basic')
    ->name('deletePet');
