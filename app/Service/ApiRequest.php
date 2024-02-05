<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

readonly class ApiRequest
{
    public function __construct(
        private Client $client,
    )
    {
    }

    public static function fromEnv(): self
    {
        $guzzleClient = new Client([
            'base_uri' => $_ENV['API_BASE_URI'],
            'headers' => ['X-REST-API-KEY' => $_ENV['X_REST_API_KEY']]
        ]);

        return new self($guzzleClient);
    }

    /**
     * @throws GuzzleException
     */
    public function getByUri(string $url, string $modalKeyInJSON)
    {
        $response = $this->client->request('GET', $url);
        $body = $response->getBody();
        $array = json_decode($body, true);
        return $array['data'][$modalKeyInJSON];
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function deletePet(int $id): void
    {
        $response = $this->client->request('DELETE', "petDelete/$id");
        $body = $response->getBody();
        $array = json_decode($body, true);

        if (!isset($array['success']) || $array['success'] === false) {
            throw new \Exception($array['message']);
        }
    }
}
