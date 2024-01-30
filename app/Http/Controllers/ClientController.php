<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ClientController extends Controller
{
    /**
     * @throws GuzzleException
     */
    public function getAll(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $client = new Client(
            [
                'base_uri' => 'https://three.test.kube-dev.vetmanager.cloud/rest/api/',
                'headers' => ['X-REST-API-KEY' => 'cf5191f41a0de30484950605f8151ec8']
            ]
        );

        $response = $client->request('GET', 'client');
        $body = $response->getBody();
        $arrayClient = json_decode($body, true);
        $newClientArray = $arrayClient['data']['client'];

        $clientDTOs = [];
        foreach ($newClientArray as $clientArray) {
            $clientDTOs[] = \App\DTO\Client::fromArray($clientArray);
        }

        return \view('client-list', ['clients' => $clientDTOs]);
    }
}
