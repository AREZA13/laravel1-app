<?php

namespace App\Http\Controllers;

use App\DTO\Client;
use App\Service\ApiRequest;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /** @throws GuzzleException */
    public function getAllLimit50(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $dtos = $this->getClientDtosByRequest('client');
        $firstDto50 = array_slice($dtos, 0, 50);
        return \view('client-list', ['clients' => $firstDto50]);
    }

    /**
     * @throws GuzzleException
     */
    public function searchClientsByFIOLim50(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $lastname = $request->input('lastname');
        $clientDTOs = $this->getClientDtosByRequest("client?limit=50&filter=[{'property':'last_name', 'value': '$lastname'}]");
        return \view('client-list', ['clients' => $clientDTOs]);
    }

    /** @return Client[]
     * @throws GuzzleException
     */
    private function getClientDtosByRequest(string $uri): array
    {
        $arrayFromRequest = ApiRequest::fromEnv()->getByUri(url: $uri, modalKeyInJSON: 'client');
        $clientDTOs = [];

        foreach ($arrayFromRequest as $clientArray) {
            $clientDTOs[] = \App\DTO\Client::fromArray($clientArray);
        }

        return $clientDTOs;
    }
}
