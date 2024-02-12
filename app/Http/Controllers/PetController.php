<?php

namespace App\Http\Controllers;

use App\DTO\DtoInterface;
use App\DTO\Pet\Pet;
use App\DTO\Pet\PetBreed;
use App\DTO\Pet\PetType;
use App\Http\Requests\StorePetPutRequest;
use App\Http\Requests\StorePetRequest;
use App\Service\ApiRequest;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws GuzzleException
     */
    public function index(int $clientId): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $array = ApiRequest::fromEnv()->getByUri(
            "pet/?filter=[{'property':'owner_id', 'value':'$clientId'},{'property':'status', 'value':'deleted', 'operator':'!='}]",
            'pet'
        );
        $petDTOs = [];
        foreach ($array as $petArray) {
            $petDTOs[] = \App\DTO\Pet\Pet::fromArray($petArray);
        }
        return \view('pet/list-by-client-id', ['pets' => $petDTOs, 'clientId' => $clientId]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(int $ownerId): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pet/form-create', ['ownerId' => $ownerId]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StorePetRequest $request, int $client): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $dataFromRequest = $request->validated();
            $dataToSend = array_merge(
                $dataFromRequest,
                ['owner_id' => $client]
            );
            ApiRequest::fromEnv()->addNewPet(data: $dataToSend);
            return redirect(route('clientPetList', ['clientId' => $client]));
        } catch (\Exception|GuzzleException $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage(),
            ])->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @throws GuzzleException
     */
    public function edit(int $petId): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $array = ApiRequest::fromEnv()->getByUri(
            "pet/$petId",
            'pet'
        );
        $petDTO = Pet::fromArray($array);
        return view('pet/form-edit', ['pet' => $petDTO]);
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
    public function destroy(string $petId): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        try {
            ApiRequest::fromEnv()->deletePet($petId);
            return Response::json([]);
        } catch (\Exception|GuzzleException $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage(),
            ])->withInput();
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
