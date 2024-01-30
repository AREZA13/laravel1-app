<?php

namespace App\DTO\Pet;
class PetBreed
{
    public function __construct(
        public ?int    $id,
        public ?string $title,
        public ?int    $pet_type_id,
    )
    {
    }

    public static function fromArray(array $array): self
    {
        return new self(
            $array['id'],
            $array['title'],
            $array['pet_type_id'],
        );
    }
}
