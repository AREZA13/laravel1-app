<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PetController extends Controller
{
    /**
     * @throws GuzzleException
     */
    public function getPetsByClientId(int $clientId): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $client = new Client(
            [
                'base_uri' => 'https://three.test.kube-dev.vetmanager.cloud/rest/api/',
                'headers' => ['X-REST-API-KEY' => 'cf5191f41a0de30484950605f8151ec8']
            ]
        );
        $response = $client->request('GET', "pet/?filter=[{'property':'owner_id', 'value':'$clientId'},{'property':'status', 'value':'deleted', 'operator':'!='}]");
        $body = $response->getBody();
        $arrayPet = json_decode($body, true);
        $newPetArray = $arrayPet['data']['pet'];

        $petDTOs = [];
        foreach ($newPetArray as $petArray) {
            $petDTOs[] = \App\DTO\Pet\Pet::fromArray($petArray);
        }

        return \view('pet-info-by-id', ['pets' => $petDTOs]);
    }
}
