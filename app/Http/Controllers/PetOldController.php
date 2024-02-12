<?php

namespace App\Http\Controllers;

use App\DTO\DtoInterface;
use App\DTO\Pet\Pet;
use App\DTO\Pet\PetBreed;
use App\DTO\Pet\PetType;
use App\Http\Requests\StorePetRequest;
use App\Service\ApiRequest;
use GuzzleHttp\Exception\GuzzleException;

class PetOldController extends Controller
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
        return \view('pet-info-by-id', ['pets' => $petDTOs, 'clientId' => $clientId]);
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

    public function viewNewPetForm(int $ownerId): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('add-new-pet', ['ownerId' => $ownerId]);
    }

    public function storeAddPetRequest(StorePetRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data = $request->validated();
            $ownerId = $data['owner_id'];
            ApiRequest::fromEnv()->addNewPet(data: $data);
            return redirect(route('clientPetList', ['clientId' => $ownerId]));
        } catch (\Exception|GuzzleException $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage(),
            ])->withInput();
        }
    }

    /**
     * @throws GuzzleException
     */
    public function viewEditPetForm(int $petId): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $array = ApiRequest::fromEnv()->getByUri(
            "pet/$petId",
            'pet'
        );
        $petDTO = Pet::fromArray($array);
        return view('put-pet', ['pet' => $petDTO]);
    }
}
