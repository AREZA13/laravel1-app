<?php

namespace App\DTO;

interface DtoInterface
{
    public static function fromArray(array $array): self;
}
