<?php

namespace App\Core\Domain\Enum;

enum PaginationLimitEnum: int
{
    case LIMIT_10 = 10;
    case LIMIT_25 = 25;
    case LIMIT_50 = 50;
    case LIMIT_100 = 100;

    public static function toArray(): array
    {
        return [
            10 => PaginationLimitEnum::LIMIT_10,
            25 => PaginationLimitEnum::LIMIT_25,
            50 => PaginationLimitEnum::LIMIT_50,
            100 => PaginationLimitEnum::LIMIT_100,
        ];

    }
    public static function toArrayValues(): array
    {
        return [
            10 => PaginationLimitEnum::LIMIT_10->value,
            25 => PaginationLimitEnum::LIMIT_25->value,
            50 => PaginationLimitEnum::LIMIT_50->value,
            100 => PaginationLimitEnum::LIMIT_100->value,
        ];

    }
}
