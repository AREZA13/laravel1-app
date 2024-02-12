<?php

use App\Http\Controllers\PetController;
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

Route::post('/registration', [\App\Http\Controllers\UserController::class, 'storeUserRegistration'])
    ->name('storeForm');

Route::post('/login', [\App\Http\Controllers\UserController::class, 'checkFromLoginForm'])
    ->name('loginForm');

Route::middleware(['auth.basic'])->group(function () {
    Route::get('/client', [\App\Http\Controllers\ClientController::class, 'getAllLimit50'])
        ->name('client');
    Route::get('/searchByFIO', [\App\Http\Controllers\ClientController::class, 'searchClientsByFIOLim50'])
        ->name('searchByFIO');
    Route::controller(\App\Http\Controllers\PetController::class)
        ->group(function () {
            Route::get('/breed/{petTypeId}', 'getBreedsByPetType')
                ->name('breedByPetType');
            Route::get('/petType', 'getAllPetTypes')
                ->name('petType');
        });
    Route::resource('client.pet', PetController::class)->middleware('auth.basic')->shallow()->except(['show']);
});
