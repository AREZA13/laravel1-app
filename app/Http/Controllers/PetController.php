<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetPutRequest;
use App\Service\ApiRequest;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePetPutRequest $request, string $petId): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $data = $request->validated();
            Log::info('putPet' . json_encode($data, JSON_UNESCAPED_UNICODE));
            $ownerId = $data['owner_id'];
            ApiRequest::fromEnv()->putPet(data: $data, petId: $petId);
            return redirect(route('clientPetList', ['clientId' => $ownerId]));
        } catch (\Exception|GuzzleException $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage(),
            ])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $petId): \Illuminate\Http\RedirectResponse
    {
        try {
            ApiRequest::fromEnv()->deletePet($petId);
            return back();
        } catch (\Exception|GuzzleException $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage(),
            ])->withInput();
        }
    }
}
