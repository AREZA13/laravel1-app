<?php

namespace App\DTO;
readonly class Client implements DtoInterface
{
    public function __construct(
        public ?int    $id,
        public ?string $address,
        public ?string $home_phone,
        public ?string $work_phone,
        public ?string $note,
        public ?int    $type_id,
        public ?int    $how_find,
        public ?float  $balance,
        public ?string $email,
        public ?string $city,
        public ?int    $city_id,
        public ?string $date_register,
        public ?string $cell_phone,
        public ?string $zip,
        public ?string $registration_index,
        public ?bool   $vip,
        public ?string $last_name,
        public ?string $first_name,
        public ?string $middle_name,
        public ?string $status,
        public ?int    $discount,
        public ?string $passport_series,
        public ?string $lab_number,
        public ?int    $street_id,
        public ?string $apartment,
        public ?bool   $unsubscribe,
        public ?bool   $in_blacklist,
        public ?string $last_visit_date,
        public ?string $number_of_journal,
        public ?string $phone_prefix,
    )
    {
    }

    public function getFullName(): string
    {
        return $this->last_name . " " . $this->first_name . " " . $this->middle_name;
    }

    public static function fromArray(array $array): self
    {
        return new self(
            $array['id'],
            $array['address'],
            $array['home_phone'],
            $array['work_phone'],
            $array['note'],
            $array['type_id'],
            $array['how_find'],
            $array['balance'],
            $array['email'],
            $array['city'],
            $array['city_id'],
            $array['date_register'],
            $array['cell_phone'],
            $array['zip'],
            $array['registration_index'],
            $array['vip'],
            $array['last_name'],
            $array['first_name'],
            $array['middle_name'],
            $array['status'],
            $array['discount'],
            $array['passport_series'],
            $array['lab_number'],
            $array['street_id'],
            $array['apartment'],
            $array['unsubscribe'],
            $array['in_blacklist'],
            $array['last_visit_date'],
            $array['number_of_journal'],
            $array['phone_prefix'],
        );
    }
}
