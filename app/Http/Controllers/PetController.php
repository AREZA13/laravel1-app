<?php

namespace App\Http\Controllers;

use App\DTO\DtoInterface;
use App\DTO\Pet\PetBreed;
use App\DTO\Pet\PetType;
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

    /**
     * @throws GuzzleException
     */
    public function getBreedsByPetType(int $petTypeId): \Illuminate\Http\JsonResponse
    {
        $array = ApiRequest::fromEnv()->getByUri(
            url: "breed?filter=[{'property':'pet_type_id', 'value':'$petTypeId'}]",
            modalKeyInJSON: 'breed'
        );
        $dtos = $this->getAsDtos($array, PetBreed::class);
        $resultArray = $this->resultArray($dtos);
        return response()->json($resultArray);
    }

    /**
     * @throws GuzzleException
     */
    public function getAllPetTypes(): \Illuminate\Http\JsonResponse
    {
        $array = ApiRequest::fromEnv()->getByUri(
            url: 'petType',
            modalKeyInJSON: 'petType'
        );
        $dtos = $this->getAsDtos($array, PetType::class);
        $resultArray = $this->resultArray($dtos);
        return response()->json($resultArray);
    }

    /**
     * @template T of DtoInterface
     * @param class-string<T> $className
     * @return T[]
     */
    private function getAsDtos(array $array, string $className): array
    {
        $dtos = [];

        foreach ($array as $petArray) {
            $dtos[] = $className::fromArray($petArray);
        }

        return $dtos;
    }

    /** @param PetBreed[]|PetType[] $dtos */
    private function resultArray(array $dtos): array
    {
        $resultArray = [];

        foreach ($dtos as $dto) {
            $resultArray[] = [
                'id' => $dto->id,
                'title' => $dto->title,
            ];
        }

        return $resultArray;
    }
}
