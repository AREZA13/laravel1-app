<?php

namespace App\Http\Controllers;

use App\Service\ApiRequest;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Redirect;

class PetController extends Controller
{
    /**
     * @throws GuzzleException
     */
    public function getPetsByClientId(int $clientId): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $array = ApiRequest::fromEnv()->getByUri(
            "pet/?filter=[{'property':'owner_id', 'value':'$clientId'},{'property':'status', 'value':'deleted', 'operator':'!='}]",
            'pet'
        );
        $petDTOs = [];
        foreach ($array as $petArray) {
            $petDTOs[] = \App\DTO\Pet\Pet::fromArray($petArray);
        }
        return \view('pet-info-by-id', ['pets' => $petDTOs]);
    }

    /**
     * @throws GuzzleException
     */
    public function deletePetWithButton(int $petId): \Illuminate\Http\RedirectResponse
    {
        try {
            ApiRequest::fromEnv()->deletePet($petId);
            return back();
        } catch (\Exception $exception) {
            return Redirect::back()->withErrors(['msg' => $exception->getMessage()]);
        }
    }
}
