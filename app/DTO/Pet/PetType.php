<?php

namespace App\DTO\Pet;
use App\DTO\DtoInterface;

class PetType implements DtoInterface
{
    public function __construct(
        public ?int    $id,
        public ?string $title,
        public ?string $picture,
        public ?string $type,
    )
    {
    }

    public static function fromArray(array $array): self
    {
        return new self(
            $array['id'],
            $array['title'],
            $array['picture'],
            $array['type'],
        );
    }
}
