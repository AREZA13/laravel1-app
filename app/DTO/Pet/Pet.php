<?php

namespace App\DTO\Pet;

use App\DTO\Client;

class Pet
{
    public function __construct(
        public ?int      $id,
        public ?int      $owner_id,
        public ?int      $type_id,
        public ?string   $alias,
        public ?string   $sex,
        public ?string   $date_register,
        public ?string   $birthday,
        public ?string   $note,
        public ?string   $breed_id,
        public ?string   $old_id,
        public ?string   $color_id,
        public ?string   $deathnote,
        public ?string   $deathdate,
        public ?string   $chip_number,
        public ?string   $lab_number,
        public ?string   $status,
        public ?string   $picture,
        public ?string   $weight,
        public ?string   $edit_date,
        public ?PetType  $type,
        public ?PetBreed $breed,
        public ?Client   $owner,
    )
    {
    }

    public static function fromArray(array $array): self
    {
        return new self(
            $array['id'],
            $array['owner_id'],
            $array['type_id'],
            $array['alias'],
            $array['sex'],
            $array['date_register'],
            $array['birthday'],
            $array['note'],
            $array['breed_id'],
            $array['old_id'],
            $array['color_id'],
            $array['deathnote'],
            $array['deathdate'],
            $array['chip_number'],
            $array['lab_number'],
            $array['status'],
            $array['picture'],
            $array['weight'],
            $array['edit_date'],
            isset($array['type']) ? PetType::fromArray($array['type']) : null,
            isset($array['breed']) ? PetBreed::fromArray($array['breed']) : null,
            isset($array['owner']) ? Client::fromArray($array['owner']) : null,
        );
    }
}
