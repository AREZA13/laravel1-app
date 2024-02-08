<?php

namespace App\Service;

use Exception;
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
     * @throws Exception
     */
    public function deletePet(int $id): void
    {
        $response = $this->client->request('DELETE', "pet/$id");
        $body = $response->getBody();
        $array = json_decode($body, true);

        if (!isset($array['success']) || $array['success'] === false) {
            throw new Exception($array['message']);
        }
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function addNewPet(array $data): void
    {
        $response = $this->client->request('POST', "pet/", ['json' => $data]);
        $body = $response->getBody();
        $array = json_decode($body, true);

        if (!isset($array['success']) || $array['success'] === false) {
            throw new Exception($array['message']);
        }
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function putPet(array $data, int $petId): void
    {
        $response = $this->client->request('PUT', "pet/$petId", ['json' => $data]);
        $body = $response->getBody();
        $array = json_decode($body, true);

        if (!isset($array['success']) || $array['success'] === false) {
            throw new Exception($array['message']);
        }
    }
}
