<?php

namespace Tests\DTO;

use App\DTO\Client;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class ClientTest extends TestCase
{

    public function testGetFullName()
    {
        $jayParsedAry = [
            "id" => 1,
            "address" => "",
            "home_phone" => "3322122",
            "work_phone" => "2234354",
            "note" => "",
            "type_id" => 1,
            "how_find" => 15,
            "balance" => "-0.0100000000",
            "email" => "neelena10@gmail.com",
            "city" => "",
            "city_id" => 251,
            "date_register" => "2012-09-29 09:14:34",
            "cell_phone" => "2321312311",
            "zip" => "",
            "registration_index" => null,
            "vip" => 0,
            "last_name" => "Иванов",
            "first_name" => "Иван",
            "middle_name" => "Иванович",
            "status" => "ACTIVE",
            "discount" => 3,
            "passport_series" => "",
            "lab_number" => "",
            "street_id" => 0,
            "apartment" => "",
            "unsubscribe" => 0,
            "in_blacklist" => 0,
            "last_visit_date" => "2024-01-18 20:30:46",
            "number_of_journal" => "",
            "phone_prefix" => "",
            "city_data" => [
                "id" => 251,
                "title" => "Ваш город",
                "type_id" => 1
            ],
            "client_type_data" => [
                "id" => 1,
                "title" => "Постоянный"
            ]
        ];

        $dto = Client::fromArray($jayParsedAry);
        assertEquals("Иванов Иван Иванович", $dto->getFullName());
    }
}
