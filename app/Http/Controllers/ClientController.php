<?php

namespace App\Http\Controllers;

use App\Service\ApiRequest;
use GuzzleHttp\Exception\GuzzleException;

class ClientController extends Controller
{
    /**
     * @throws GuzzleException
     */
    public function getAll(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $array = ApiRequest::fromEnv()->getByUri(
            'client',
            'client'
        );
        $clientDTOs = [];
        foreach ($array as $clientArray) {
            $clientDTOs[] = \App\DTO\Client::fromArray($clientArray);
        }
        return \view('client-list', ['clients' => $clientDTOs]);
    }
}
