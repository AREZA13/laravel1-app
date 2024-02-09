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

Route::get('/view-new-pet-form/{ownerId}', [\App\Http\Controllers\PetOldController::class, 'viewNewPetForm'])
    ->name('view-new-pet-form');
Route::post('/pet', [\App\Http\Controllers\PetOldController::class, 'storeAddPetRequest'])->name('store-pet');

Route::post('/registration', [\App\Http\Controllers\UserController::class, 'storeUserRegistration'])->name('storeform');
Route::post('/login', [\App\Http\Controllers\UserController::class, 'checkFromLoginForm'])->name('loginform');

Route::get('/client', [\App\Http\Controllers\ClientController::class, 'getAllLimit50'])
    ->middleware('auth.basic')
    ->name('client');
Route::get('/searchByFIO', [\App\Http\Controllers\ClientController::class, 'searchClientsByFIOLim50'])
    ->middleware('auth.basic')
    ->name('searchByFIO');
Route::get('/client/{clientId}', [\App\Http\Controllers\PetOldController::class, 'getPetsByClientId'])
    ->middleware('auth.basic')
    ->name('clientPetList');

Route::get('/breed/{petTypeId}', [\App\Http\Controllers\PetOldController::class, 'getBreedsByPetType'])
    ->name('breedByPetType');
Route::get('/petType', [\App\Http\Controllers\PetOldController::class, 'getAllPetTypes'])
//    ->middleware('auth.basic') #TODO try to uncomment and duplicate the same for getAllBreeds
    ->name('petType');

Route::any('/view-edit-pet-form/{petId}', [\App\Http\Controllers\PetOldController::class, 'viewEditPetForm'])
    ->name('view-edit-pet-form');


Route::resource('pet', PetController::class)->middleware('auth.basic')->except(['show']);
